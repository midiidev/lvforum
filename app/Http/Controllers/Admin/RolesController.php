<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    /**
     * Update a user's role.
     * 0 = root, 1 = admin, 2 = mod, 3 = user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
            'new_role' => 'required',
        ]);

        $user = User::where('username', $request->username)->first();

        if ($user->role <= auth()->user()->role) {
            return back()->with('error', 'You cannot change the role of this user.');
        }

        $user->role = $request->new_role;
        $user->save();

        return back()->with('success', 'Role of ' . $user->username . ' updated successfully');
    }

    /**
     * Display a user's role.
     * 0 = root, 1 = admin, 2 = mod, 3 = user
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function view(Request $request)
    {
        $request->validate([
            'username' => 'required|exists:users,username',
        ]);

        $user = User::where('username', $request->username)->first();

        return back()->with('role', $user->username . '\'s role is ' . $user->role);
    }
}
