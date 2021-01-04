<?php

namespace App\Http\Controllers;

use App\Helpers\Utils;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index($id) {
        $user = User::find($id);
        $posts = $user->receivedPosts;
        if(Auth::id() != $id && !Auth::user()->isFriend($user)) {
            Utils::returnUnauthorizedResponse();
        }
        return view('profile', compact('user', 'posts'));
    }
}
