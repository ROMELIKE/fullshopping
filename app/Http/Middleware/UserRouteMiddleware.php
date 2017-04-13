<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserRouteMiddleware
{
    /**
     * Handle an incoming request.
     *
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
