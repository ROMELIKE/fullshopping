<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class AdminRouteMiddleware
{
    /**
     * Handle an incoming request.
     * I want: any route access to admin route, need to check Login before it done.
     * login account just be a "admin", or "supper admin".
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::check() && Auth::user()['accessible'] > 0) {
            return $next($request);
        } else {
            return redirect()->route('getlogin');
        }
    }
}
