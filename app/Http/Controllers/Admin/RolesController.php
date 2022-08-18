<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function update()
    {
        request()->validate([
            'username' => 'required|exists:users,username',
            'new_role' => 'required',
        ]);

        $user = User::where('username', request('username'))->first();

        if ($user->role <= auth()->user()->role) {
            return back()->with('error', 'You cannot change the role of this user.');
        }

        $user->role = request('new_role');
        $user->save();

        return back()->with('success', 'Role of ' . $user->username . ' updated successfully');
    }

    public function view()
    {
        request()->validate([
            'username' => 'required|exists:users,username',
        ]);

        $user = User::where('username', request('username'))->first();

        return back()->with('role', $user->username . '\'s role is ' . $user->role);
    }
}
