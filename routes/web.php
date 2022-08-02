<?php

use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\CoinsController;
use App\Http\Controllers\DonatorsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PrintController;
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

Route::get('/', function () {
    return view('dashboard');
});

Route::controller(HomeController::class)->group(function () {
    Route::get('/', 'index')->name('index');
});

Route::get('/dashboard', function () {
    return view('home');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';


//Resources routing
Route::resources([
    'users' => UsersController::class,
    'roles' => RolesController::class,
    'coins' => CoinsController::class,
    'donators' => DonatorsController::class,
]);

//Controller routing
Route::controller(UsersController::class)->group(function () {
    Route::post('assignrole', 'assignment')->name('assignrole');
});

Route::controller(RolesController::class)->group(function () {
    Route::get('assign', [RolesController::class, 'assign'])->name('assign');
});

Route::controller(PrintController::class)->group(function () {
    Route::get('/print', 'index')->name('print');
});
