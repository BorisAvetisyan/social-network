<?php

namespace App\Services;

use App\Models\Relationship;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RelationshipService {


    /** Creates new relation
     * @param User $user
     * @return Relationship
     */
    public function create(User $user) {
        $relationship = new Relationship();
        $relationship->sender_id = Auth::id();
        $relationship->receiver_id = $user->id;
        $relationship->status = Relationship::PENDING;
        $relationship->save();
        return $relationship;
    }

    public function update(User $user, $status) {
        $authId = Auth::id();
        $userId = $user->id;
        $relationship = Relationship::whereRaw("(receiver_id = $authId and sender_id = $userId) or (receiver_id = $userId and sender_id = $authId)")->first();
        if(!empty($relationship)) {
            $relationship->status = $status;
            $relationship->save();
        }
        return $relationship;
    }
}
