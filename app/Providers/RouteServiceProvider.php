<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('create', function (Request $request) {
//            return [
//                Limit::perMinutes(5, 10)->by($request->ip())->response(function () { return back()->with('error', 'Too many requests.'); }),
//                Limit::perMinutes(5, 5)->by($request->user()?->id)->response(function () { return back()->with('error', 'Too many requests.'); })
//            ];
        });

        RateLimiter::for('update', function (Request $request) {
//            return [
//                Limit::perMinute(15)->by($request->ip())->response(function () { return back()->with('error', 'Too many requests.'); }),
//                Limit::perMinute(10)->by($request->user()?->id)->response(function () { return back()->with('error', 'Too many requests.'); })
//            ];
        });

        RateLimiter::for('update', function (Request $request) {
//            return [
//                Limit::perMinute(15)->by($request->ip())->response(function () { return back()->with('error', 'Too many requests.'); }),
//                Limit::perMinute(10)->by($request->user()?->id)->response(function () { return back()->with('error', 'Too many requests.'); })
//            ];
        });

        RateLimiter::for('login', function (Request $request) {
//            return [
//                Limit::perMinute(rand(2, 4))->by($request->ip())->response(function () { return back()->with('error', 'Too many requests.'); })
//            ];
        });

        RateLimiter::for('register', function (Request $request) {
//            return [
//                Limit::perMinutes(7200, 10)->by($request->ip())->response(function () { return back()->with('error', 'Too many requests.'); })
//            ];
        });
    }
}
