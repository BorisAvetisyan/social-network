<?php

namespace App\Http\Controllers;

use App\Models\Relationship;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index($id) {
        $user = User::find($id);
        $posts = $user->receivedPosts;
        $singleUserRelationship = Auth::user()->singleRelationShipWithUser($user);
        $isFriend = !empty($singleUserRelationship) && $singleUserRelationship->status == Relationship::APPROVED;
        return view('profile', compact('user', 'posts', 'singleUserRelationship', 'isFriend'));
    }
}
