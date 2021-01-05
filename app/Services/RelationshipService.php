<?php

/**
 * This service is responsible for relationship related changes
 */

namespace App\Services;

use App\Models\Relationship;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RelationshipService {


    /** Creates new relation
     * @param User $user
     * @return Relationship
     */
    private function create(User $user) {
        $relationship = new Relationship();
        $relationship->sender_id = Auth::id();
        $relationship->receiver_id = $user->id;
        $relationship->status = Relationship::PENDING;
        $relationship->save();
        return $relationship;
    }

    public function createOrUpdate(User $user) {
        $userId = $user->id;

        $sentRelationship = Relationship::where("sender_id", Auth::id())->where("receiver_id", $userId)->first();
        if(!empty($sentRelationship)) {
            return $this->handleSentRelationshipResponse($sentRelationship);
        }

        $receivedRelationship = Relationship::where("receiver_id", Auth::id())->where("sender_id", $userId)->first();
        if(!empty($receivedRelationship)) {
            return $this->handleReceivedRelationshipResponse($receivedRelationship, $user);
        }

        $this->create($user);
        return response()->json(['success' => true]);
    }

    /**
     * @param $relationship
     * @return \Illuminate\Http\JsonResponse
     */
    private function handleSentRelationshipResponse($relationship) {
        if($relationship->status == Relationship::REJECTED) {
            $relationship->status = Relationship::PENDING;
            $relationship->save();
        }
        if($relationship->status == Relationship::APPROVED) {
            return response()->json(['success' => true, 'message' => 'This user is already in your friends list']);
        }
        return response()->json(['success' => true, 'message' => 'Friend request has been successfully sent']);
    }

    /**
     * @param $receivedRelationship
     * @param User $user
     * @return \Illuminate\Http\JsonResponse
     */
    private function handleReceivedRelationshipResponse($receivedRelationship, User $user) {
        if($receivedRelationship->status == Relationship::REJECTED) {
            if($receivedRelationship->receiver_id == Auth::id()) {
                $receivedRelationship->receiver_id = $user->id;
                $receivedRelationship->sender_id = Auth::id();
            }
            $receivedRelationship->status = Relationship::PENDING;
            $receivedRelationship->save();
            return response()->json(['success' => true, 'message' => 'Friend request has been successfully sent']);
        }
        if($receivedRelationship->status == Relationship::APPROVED) {
            return response()->json(['success' => true, 'message' => 'This user is already in your friends list']);
        }
    }
}
