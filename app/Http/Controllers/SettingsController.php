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

    public function changePassword()
    {
        request()->validate([
            'current_password' => 'required',
            'new_password'     => 'required|confirmed|min:8|max:255'
        ]);

        if (!Hash::check(request('current_password'), auth()->user()->password)) {
            return back()->withErrors(['current_password' => 'The password you provided is incorrect.']);
        }

        $user = auth()->user();
        $user->password = request('new_password');
        $user->save();

        return back()->with('success', 'Password successfully updated.');
    }

    public function changeIcon()
    {
        request()->validate([
            'icon' => 'image|mimes:jpeg,jpg,png,gif|max:1024' // 1MB
        ]);

        $file = request()->file('icon');
        $extension = $file->getClientOriginalExtension();
        $file->storeAs('public/avatars', auth()->user()->id . '.' . $extension);

        $user = auth()->user();
        $user->icon = '/storage/avatars/' . auth()->user()->id . '.' . $extension;
        $user->save();

        return back()->with('success', 'Icon successfully updated.');
    }
}
