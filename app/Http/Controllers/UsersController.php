<?php

namespace App\Http\Controllers;

use App\Models\Relationship;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UsersController extends Controller
{
    private $userService;

    public function __construct(UserService $userService) {
         $this->userService = $userService;
    }

    /**
     * Users search functionality
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request) {
        return $this->userService->getUsers($request);
    }

    public function notificationRespond(Request $request) {
        $suggestionId = $request->get('notification');
        $action = $request->get('action');

        $relationship = Relationship::find($suggestionId);
        $relationship->status = $action;
        try {
            $relationship->save();
        } catch (\Exception $exception) {
            return response()->json(['success' => false, 'message' => 'Failed to change status']);
        }
        return response()->json(['success' => true]);
    }


    public function data(Request $request) {
        $status = $request->get('status');
        $target = $request->get('target');
        $authUserId = Auth::id();


        $query = User::query();
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
            $query->where('relationships.status', '=', $status);
        }

        $data = $query->get()->all();
        return response()->json([
            'meta' => $this->getMetaInformation($request->get('pagination', []), count($data)),
            'data' => $data
        ]);
    }

    /**
     * Returns all notifications where receiver is the authenticated user and the status is "pending"
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function notifications(Request $request) {
        $query = User::query();
        $query->select('relationships.id', 'users.name', 'users.email', 'users.surname', 'relationships.status');
        $query->join('relationships', 'relationships.receiver_id', '=', 'users.id');
        $query->where('relationships.receiver_id','=', user()->id);

        $query->where('relationships.status', '=', Relationship::PENDING);

        $data = $query->get()->all();
        return response()->json([
            'meta' => $this->getMetaInformation($request->get('pagination', []), count($data)),
            'data' => $data
        ]);
    }

    /**
     * Returns meta information for datatable in client side
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
}
