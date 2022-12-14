<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function view()
    {
        return view('settings');
    }

    /**
     * Change the currently logged-in user's password.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'     => 'required|confirmed|min:8|max:255'
        ]);

        if (!Hash::check($request->current_password, auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'The password you provided is incorrect.']);
        }

        $user = auth()->user();
        $user->password = $request->new_password;
        $user->save();

        return back()->with('success', 'Password successfully updated.');
    }

    /**
     * Change the currently logged-in user's icon/profile picture.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changeIcon(Request $request)
    {
        $request->validate([
            'icon' => 'image|mimes:jpeg,jpg,png,gif|max:1024' // 1MB
        ]);

        if ($request->icon == null) {
            auth()->user()->icon = null;
            auth()->user()->save();

            return back()->with('success', 'Icon successfully updated.');
        }

        $file = $request->file('icon');
        $extension = $file->getClientOriginalExtension();
        $filehash = crc32($file);
        $file->storeAs('public/avatars', auth()->user()->id . '.' . $extension);

        $user = auth()->user();
        $user->icon = '/storage/avatars/' . auth()->user()->id . '.' . $extension . '?' . $filehash; // Add file hash to prevent caching
        $user->save();

        return back()->with('success', 'Icon successfully updated.');
    }

    public function changeBio(Request $request)
    {
        if (!auth()->check()) {
            return back()->with('error', 'You are not logged in.');
        }

        $request->validate([
            'bio' => 'max:500'
        ]);

        $user = auth()->user();
        $user->bio = $request->bio;
        $user->save();

        return back();
    }
}
