<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CheckIfBanned
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->check() && auth()->user()->expiration_date && auth()->user()->expiration_date > now()) {
            $unban = Carbon::parse(auth()->user()->expiration_date)->diffForHumans();
            auth()->logout();
            return redirect('/')->with('error', 'You are banned from the site. You will be unbanned in ' . $unban . '.');
        } else if (auth()->check() && auth()->user()->expiration_date && Carbon::parse(auth()->user()->expiration_date)->isPast()) {
            auth()->user()->expiration_date = null;
            auth()->user()->save();
        }

        return $next($request);
    }
}
