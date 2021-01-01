<?php

namespace App\Http\Controllers;

use App\Models\Relationship;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    /**
     * Creates new relationship row with corresponding sender and receiver ids.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function friend(Request $request) {
        $user = $request->get('user');
        if(!is_numeric($user)) {
            return response()->json(['success' => false, 'message' => 'Invalid arguments are specified']);
        }
        $user = User::find($user);
        if(empty($user)) {
            return response()->json(['success' => false, 'message' => 'Invalid arguments are specified']);
        }
        return $this->userService->createRelation($user);
    }

    public function unfriend(Request $request) {
        $user = $request->get('user');
        if(!is_numeric($user)) {
            return response()->json(['success' => false, 'message' => 'Invalid arguments are specified']);
        }
        $user = User::find($user);
        if(empty($user)) {
            return response()->json(['success' => false, 'message' => 'Invalid arguments are specified']);
        }
        return $this->userService->removeRelation();
    }

    public function suggestionRespond(Request $request) {
        $suggestionId = $request->get('suggestion');
        $action = $request->get('action');

        // @todo validate request data;

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
        $authUserId = Auth::user()->id;

        $query = User::query();
        $query->join('relationships', 'relationships.receiver_id', '=', 'users.id');
        if($status === Relationship::APPROVED) {
            $query->join('relationships as rs', 'rs.sender_id', '=', 'users.id');
            $query->where('rs.status', '=', $status);
            $query->whereRaw('(rs.sender_id = ? or relationships.receiver_id = ?)', [$authUserId, $authUserId]);
        } elseif ($status === Relationship::REJECTED) {
            $query->where('sender_id', '=', $authUserId);
        } elseif ($status === Relationship::PENDING) {
            $query->where('sender_id', '=', $authUserId);
        }

        $query->where('relationships.status', '=', $status);

        $data = $query->get()->all();
        return response()->json([
            'meta' => $this->getMetaInformation($request->get('pagination', []), count($data)),
            'data' => $data
        ]);
    }

    public function getMetaInformation($pagination, $dataCount) {
        return array(
            'page' => $pagination['page'],
            'pages' => ceil($dataCount / $pagination['perpage']),
            'perpage' => $pagination['perpage'],
            'total' => $dataCount
        );
    }
}
