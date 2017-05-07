<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserRouteMiddleware
{
    /**
     * Handle an incoming request.
     * * I want: any route access to user route(some route), need to check Login before it done.
     * login account only be a "simple user".
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::guard('simpleUser')->check()) {
            return redirect()->route('gethome');
        } else {
            return $next($request);
        }
    }
}
