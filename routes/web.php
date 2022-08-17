<?php

use App\Http\Controllers\AuthController;
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
    return view('landing');
});

// authentication routes
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register_create')->middleware('guest');
    Route::post('register', 'register_store')->middleware('guest');

    Route::get('login', 'login_create')->middleware('guest');
    Route::post('login', 'login_store')->middleware('guest');

    Route::post('logout', 'destroy')->middleware('auth');
});
