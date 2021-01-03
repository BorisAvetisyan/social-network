<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'users'], function () {
        Route::get('search', [\App\Http\Controllers\UsersController::class, 'search']);
        Route::post('data', [\App\Http\Controllers\UsersController::class, 'data'])->name('users.data');

        Route::post('friend', [\App\Http\Controllers\RelationshipController::class, 'friend']);
        Route::post('unfriend', [\App\Http\Controllers\RelationshipController::class, 'unfriend']);

        Route::post('notification/respond', [\App\Http\Controllers\RelationshipController::class, 'notificationRespond']);
        Route::post('notifications/data', [\App\Http\Controllers\UsersController::class, 'notifications'])->name('notifications.data');
        Route::get('profile/{id}', [\App\Http\Controllers\ProfileController::class, 'index']);
    });

    Route::post('user/post', [\App\Http\Controllers\PostsController::class, 'post']);
    Route::post('relationships/cancel', [\App\Http\Controllers\RelationshipController::class, 'cancelRequest']);
});

Auth::routes(['reset' => false]);
