<?php

namespace App\Http\Controllers;

use App\Models\User;

class ProfileController extends Controller
{
    public function index($id) {
        $user = User::find($id);
        $posts = $user->receivedPosts;
        return view('profile', compact('user', 'posts'));
    }
}
