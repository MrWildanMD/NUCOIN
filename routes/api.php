<?php

use App\Http\Controllers\Api\AuthApiController;
use App\Http\Controllers\Api\CoinsApiController;
use App\Http\Controllers\Api\DonatorsApiController;
use App\Http\Controllers\Api\UsersApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(AuthApiController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');
    Route::post('logout', 'logout');
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(UsersApiController::class)->group(function () {
    Route::get('users', 'index')->name('users');
});

Route::apiResources([
    'coins' => CoinsApiController::class,
    'donators' => DonatorsApiController::class,
]);
