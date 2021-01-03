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
        $target = $request->get('term');

        $this->makeUserSearchCriteria($target, $query);
        $query->select('users.id', 'users.name', 'users.surname', 'users.email', DB::raw("(case when rs.status is not null then rs.status else rs2.status end) as status"));

        $query->leftJoin('relationships as rs', 'rs.sender_id', '=', 'users.id');
        $query->leftJoin('relationships as rs2', 'rs2.receiver_id', '=', 'users.id');
        $query->where('users.id', '!=', Auth::id());

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
        $target = $request->get('target');
        $authUserId = Auth::id();

        $query = User::query();

        $this->makeUserSearchCriteria($target, $query);

        $query->leftJoin('relationships as rs', 'rs.receiver_id', '=', 'users.id');
        if($status === Relationship::APPROVED) {
            $query->select(
                DB::raw('(case when rs.id is not null then rs.id else rs2.id end) as id'),
                DB::raw('(case when rs.status is not null then rs.status else rs2.status end) as status, users.id as user_id'),
                'users.name', 'users.email', 'users.surname');
            $query->leftJoin('relationships as rs2', 'rs2.sender_id', '=', 'users.id');
            $query->whereRaw("(rs.status = '$status' or rs2.status = '$status')");
            $query->where('users.id', '!=', $authUserId);
        } elseif ($status === Relationship::REJECTED || $status === Relationship::PENDING) {
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

    /**
     * UTIL function
     * @param $target
     * @param $query
     */
    public function makeUserSearchCriteria($target, $query) {
        if(!empty($target)) {
            $query->whereRaw('LOWER(users.email) like \'%'. $target .'%\' ')
                ->orWhereRaw('LOWER(users.name) like \'%'. $target .'%\' ')
                ->orWhereRaw('LOWER(users.surname) like \'%'. $target .'%\' ');
        }
    }
}
