<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;
use App\Models\Post;
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
    return view('home', [
        'posts' => Post::all()->sortByDesc('id')
    ]);
});

Route::get('posts/{post}', function (Post $post) {
    return view('posts.post', [
        'post' => $post
    ]);
});

// authentication routes
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register_create')->middleware('guest')->name('register');
    Route::post('register', 'register_store')->middleware('guest');

    Route::get('login', 'login_create')->middleware('guest')->name('login');
    Route::post('login', 'login_store')->middleware('guest');

    Route::post('logout', 'destroy')->middleware('auth')->name('logout');
});

Route::controller(PostController::class)->group(function () {
    Route::get('create-post', 'create')->middleware('auth');
    Route::post('create-post', 'store')->middleware('auth');
});
