<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BanController extends Controller
{
    /**
     * Ban a user for the specified amount of time.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'time' => 'required|integer|min:0', // time in days
        ]);

        $user = User::where('username', $request->username)->first();
        $user->expiration_date = now()->addDays($request->time);
        $user->save();

        return back()->with('success', 'User banned successfully');
    }
}
