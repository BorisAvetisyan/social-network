<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;

class LoginController extends Controller
{
    public function index() {
        return view('auth.login');
    }

    public function login(LoginRequest $request) {
        // todo login
    }
}
