<?php

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

Route::group(['middleware' => ['auth.basic']], function () {
    Route::get('/', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::group(['prefix' => 'users'], function () {
        Route::get('search', [\App\Http\Controllers\UsersController::class, 'search']);
        Route::post('friend', [\App\Http\Controllers\UsersController::class, 'friend']);
        Route::post('unfriend', [\App\Http\Controllers\UsersController::class, 'unfriend']);
        Route::post('notification/respond', [\App\Http\Controllers\UsersController::class, 'notificationRespond']);
        Route::post('notifications/data', [\App\Http\Controllers\UsersController::class, 'notifications'])->name('notifications.data');
        Route::post('data', [\App\Http\Controllers\UsersController::class, 'data'])->name('users.data');
    });
});

Route::get('login', [\App\Http\Controllers\LoginController::class, 'index'])->name('login.index');
Route::post('login', [\App\Http\Controllers\LoginController::class, 'login'])->name('login');
Route::get('register', [\App\Http\Controllers\RegisterController::class, 'index'])->name('register.index');
Route::post('register', [\App\Http\Controllers\RegisterController::class, 'register'])->name('register');
