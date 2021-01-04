<?php

/**
 * This service is responsible for relationship related changes
 */

namespace App\Services;

use App\Models\Relationship;
use App\Models\User;
use Illuminate\Http\Request;
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
            return $this->sentRelationshipResponse($sentRelationship);
        }

        $receivedRelationship = Relationship::where("receiver_id", Auth::id())->where("sender_id", $userId)->first();
        if(!empty($receivedRelationship)) {
            if($receivedRelationship->status == Relationship::APPROVED) {
                return response()->json(['success' => true, 'message' => 'This user is already in your friends list']);
            }
            return response()->json(['success' => true, 'message' => 'You already have notification from this user']);
        }

        $this->create($user);
        return response()->json(['success' => true]);
    }

    private function sentRelationshipResponse($sentRelationship) {
        if($sentRelationship->status == Relationship::REJECTED) {
            $sentRelationship->status = Relationship::PENDING;
            $sentRelationship->save();
        }
        if($sentRelationship->status == Relationship::APPROVED) {
            return response()->json(['success' => true, 'message' => 'This user is already in your friends list']);
        }
        return response()->json(['success' => true, 'message' => 'You have already sent friend request to this user']);
    }
}
