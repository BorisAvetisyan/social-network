<?php

/**
 * This service is responsible for users related actions
 */

namespace App\Services;

use App\Models\Relationship;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserService {

    const USERS_MAXIMUM_COUNT = 20;

    /**
     * Returns users data based on request parameter(s)
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllUsers(Request $request) {
        $query = User::query();
        $target = strtolower($request->get('term', ''));

        $query->select('users.id', 'users.name', 'users.surname', 'users.email');

        $query->where('users.id', '!=', Auth::id());
        $this->makeUserSearchCriteria($target, $query);

        $query->limit(self::USERS_MAXIMUM_COUNT);

        $data = $query->get()->all();
        return response()->json(['results' => $data]);
    }

    /**
     * Creates new user
     * @param Request $request
     * @return User
     */
    public function createUser(Request $request) {
        $user = new User();
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->surname = $request->get('surname');
        $user->password = Hash::make($request->get('password'));
        $user->save();
        return $user;
    }

    /**
     * This function responsible for fetching data from the database based on target that user search or relationship status that has.
     * @param Request $request
     * @return JsonResponse
     */
    public function getUsers(Request $request) {
        $status = $request->get('status');
        $target = strtolower($request->get('target'));
        $authUserId = Auth::id();
        $query = null;

        if($status === Relationship::APPROVED) {
            $query = $this->makeFriendsQuery($target);
        } elseif ($status === Relationship::REJECTED || $status === Relationship::PENDING) {
            $query = User::query();
            $this->makeUserSearchCriteria($target, $query);
            $query->leftJoin('relationships as rs', 'rs.receiver_id', '=', 'users.id');
            $query->where('sender_id', '=', $authUserId);
            $query->where('rs.status', '=', $status);
        }

        $count = $query->count();
        $this->applyPaginationCondition($request, $query);

        $data = $query->get()->all();
        return response()->json([
            'meta' => $this->getMetaInformation($request->get('pagination', []), $count),
            'data' => $data
        ]);
    }

    /**
     * UTIL function: Returns meta information for the datatable in client side
     * @param $pagination
     * @param $dataCount
     * @return array
     */
    public function getMetaInformation($pagination, $dataCount) {
        return array(
            'page' => $pagination['page'],
            'pages' => ceil($dataCount / $pagination['perpage']),
            'perpage' => $pagination['perpage'],
            'total' => $dataCount
        );
    }

    /**
     * UTIL function: Defines pagination condition for the corresponding query
     * @param Request $request
     * @param $query
     */
    public function applyPaginationCondition(Request $request, $query) {
        $pagination = $request->get('pagination', []);
        $perPage = isset($pagination['perpage']) ? $pagination['perpage'] : 50;
        $pageNumber = !empty($pagination['page']) ? $pagination['page'] : 1;
        $query->limit($perPage);
        $query->offset(($pageNumber - 1) * $perPage);
    }

    public function makeFriendsQuery($target) {
        $authId = Auth::id();
        $approved = Relationship::APPROVED;
        $query = Relationship::query();
        $query->select(
            'relationships.id',
          'relationships.status',
          DB::raw("(case when u.id = $authId then u2.id else u.id end) as user_id"),
          DB::raw("(case when u.id = $authId then u2.name else u.name end) as name"),
          DB::raw("(case when u.id = $authId then u2.surname else u.surname end) as surname"),
          DB::raw("(case when u.id = $authId then u2.email else u.email end) as email"),
        );
        $query->leftJoin('users as u', 'u.id', '=', 'relationships.sender_id');
        $query->leftJoin('users as u2', 'u2.id', '=', 'relationships.receiver_id');
        $query->whereRaw("(sender_id = $authId or receiver_id = $authId) and status = '$approved' ");

        if(!empty($target)) {
            $query->whereRaw('
                    (case when u.id = '.$authId.' then (LOWER(u2.email) like \'%'. $target .'%\' or
                               LOWER(u2.name) like \'%'. $target .'%\' or
                               LOWER(u2.surname) like \'%'. $target .'%\'
                    ) else (LOWER(u.email) like \'%'. $target .'%\' or
                               LOWER(u.name) like \'%'. $target .'%\' or
                               LOWER(u.surname) like \'%'. $target .'%\'
                    ) end )');
        }
        return $query;
    }

    /**
     * UTIL function
     * @param $target
     * @param $query
     * @param string $alias
     */
    public function makeUserSearchCriteria($target, $query, $alias = 'users') {
        if(!empty($target)) {
            $query->whereRaw('(LOWER('.$alias.'.email) like \'%'. $target .'%\' or
                               LOWER('.$alias.'.name) like \'%'. $target .'%\' or
                               LOWER('.$alias.'.surname) like \'%'. $target .'%\'
                    )');
        }
    }
}
