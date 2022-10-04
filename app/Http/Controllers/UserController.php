<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Return a view containing all necessary info to display the profile page
     *
     * @param $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    private function profileView($user)
    {
        return view('users.profile', [
            'user'      => $user,
            'recent'    => Post::where('user_id', $user->id)->latest()->limit(10)->get(),
            'postCount' => Post::where('user_id', $user->id)->count(),
            'commentCount' => Comment::where('user_id', $user->id)->count()
        ]);
    }

    /**
     * Show a user's profile
     *
     * @param User $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|void
     */
    public function view(User $user)
    {
        if ($user->expiration_date != null) {
            if (auth()->check() && auth()->user()->role > 3) {
                return $this->profileView($user);
            } else {
                abort(404);
            }
        } else {
            return $this->profileView($user);
        }
    }
}
