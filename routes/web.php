<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BanController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\SettingsController;
use App\Models\Category;
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

// authentication routes
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register_create')->middleware('guest')->name('register');
    Route::post('register', 'register_store')->middleware(['guest', 'throttle:register']);

    Route::get('login', 'login_create')->middleware('guest')->name('login');
    Route::post('login', 'login_store')->middleware(['guest', 'throttle:login']);

    Route::post('logout', 'destroy')->middleware('auth')->name('logout');
});

Route::controller(PostController::class)->group(function () {
    Route::get('/', 'index')->name('home');

    Route::get('/posts/category/{category:slug}', function (Category $category) {
        return view('home', [
            'posts' => Post::with('user', 'comments')
                ->where('category_id', $category->id)
                ->get()
                ->sortByDesc('id'),
            'categories' => Category::all(),
            'category' => $category
        ]);
    });

    Route::get('posts/post/{post}', function (Post $post) {
        return view('posts.post', [
            'post' => $post
        ]);
    });

    Route::get('create-post/category/{category}', 'create')->middleware('auth');
    Route::post('create-post', 'store')->middleware(['auth', 'throttle:create']);

    Route::get('posts/post/{post}/edit', 'edit')->middleware('auth');

    Route::post('posts/post/{post}/delete', 'destroy')->middleware(['auth', 'throttle:update']);
    Route::post('posts/post/{post}/edit', 'update')->middleware(['auth', 'throttle:update']);
});

Route::controller(CommentController::class)->group(function () {
    Route::post('posts/post/{post}/comment', 'store')->middleware(['auth', 'throttle:create']);
    Route::post('/posts/comments/{comment}/delete', 'destroy')->middleware(['auth', 'throttle:update']);
});

Route::controller(SettingsController::class)->group(function () {
    Route::get('settings', 'view')->middleware('auth');
    Route::post('settings/change-password', 'changePassword')->middleware('auth');
    Route::post('settings/change-icon', 'changeIcon')->middleware(['auth', 'throttle:update']);
});

// admin routes
Route::prefix('admin')->group(function () {
    Route::middleware(['admin'])->group(function () {
        Route::get('/panel', function () {
            return view('admin.panel');
        });

        Route::post('/change-role', [RolesController::class, 'update']);
        Route::post('/check-role', [RolesController::class, 'view']);

        Route::post('/change-default-icon', [AdminController::class, 'changeDefaultIcon']);

        Route::post('/ban-user', [BanController::class, 'store']);
    });
});
