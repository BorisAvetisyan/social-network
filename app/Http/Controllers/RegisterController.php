<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\UserService;

class RegisterController extends Controller
{
    public function index() {
        return view('auth.register');
    }

    public function register(RegisterRequest $request, UserService $userService) {
        $userService->createUser($request);
        return redirect(route('dashboard'));
    }
}
