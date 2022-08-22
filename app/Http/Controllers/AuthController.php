<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{

    /**
     * Show the register page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function register_create()
    {
        return view('auth.register');
    }

    /**
     * Create the new user and log them in.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register_store(Request $request)
    {
        $attributes = $request->validate([
            'username' => 'required|alpha_dash|unique:users,username|min:3|max:50',
            'email'    => 'required|email|unique:users,email|max:255',
            'password' => 'required|confirmed|min:8|max:255'
        ]);

        $user = User::create($attributes);
        event(new Registered($user));
        auth()->login($user);

        return redirect('/')->with('success', 'Account successfully created. Welcome to ' . env('APP_NAME') . '!');
    }

    /**
     * Show the login page.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function login_create()
    {
        return view('auth.login');
    }


    /**
     * Check if the credentials are valid and log the user in.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function login_store(Request $request)
    {
        $attributes = $request->validate([
            'email' => 'required|exists:users,email',
            'password' => 'required'
        ]);

        if (auth()->attempt($attributes)) {
            session()->regenerate();

            return redirect('/')->with('success', 'Welcome back, ' . auth()->user()->username . '!');
        }

        throw ValidationException::withMessages([
            'username' => 'The username or password you provided is incorrect.',
            'password' => 'The username or password you provided is incorrect.'
        ]);
    }

    /**
     * Log the user out.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Successfully logged out.');
    }
}
