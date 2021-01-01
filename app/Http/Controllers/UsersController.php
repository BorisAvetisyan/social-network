<?php

namespace App\Http\Controllers;

use App\Models\Relationship;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\Request;

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
}
