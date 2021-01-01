<?php

namespace App\Http\Controllers;

use App\Services\UserService;

class DashboardController extends Controller
{

    public function index() {
        $userService = app()->make(UserService::class);
        $suggestions = $userService->getSuggestions();
        $requestedList = $userService->getRequestedList();

        return view('dashboard', compact('suggestions', 'requestedList'));
    }
}
