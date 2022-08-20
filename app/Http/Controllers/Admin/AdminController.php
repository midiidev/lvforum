<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function changeDefaultIcon(Request $request)
    {
        $request->validate([
            'icon' => 'image|mimes:png|max:1024' // 1MB
        ]);

        $file = $request->file('icon')->storeAs('public/avatars', '_nopfp.png');

        return back()->with('success', 'Default icon successfully updated.');
    }
}
