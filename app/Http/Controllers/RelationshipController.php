<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\Relationship;
use App\Models\User;
use App\Services\RelationshipService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RelationshipController extends Controller
{
    private $relationshipService;

    public function __construct(RelationshipService $relationshipService) {
        $this->relationshipService = $relationshipService;
    }

    public function cancelRequest(Request $request) {
        $relationship = Relationship::find($request->get('relationship'));
        if($relationship->sender_id != Auth::id()) {
            return Utils::returnUnauthorizedResponse();
        }
        $relationship->delete();
        return response()->json(['success' => true]);
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
        return $this->relationshipService->createOrUpdate($user);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function unfriend(Request $request) {
        $relationship = $request->get('relationship');
        if(!is_numeric($relationship)) {
            return response()->json(['success' => false, 'message' => 'Invalid arguments are specified']);
        }
        $relationship = Relationship::find($relationship);
        if(empty($relationship) || ($relationship->receiver_id != Auth::id() && $relationship->sender_id != Auth::id())) {
            return response()->json(['success' => false, 'message' => 'Invalid arguments are specified']);
        }
        $relationship->delete();
        return response()->json(['success' => true]);
    }


    /**
     * Handle received friend requests. approve/reject
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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
}
