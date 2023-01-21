<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class Userl
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
        // if (auth()->user()->is_admin == 1) {
        //     return $next($request);
        // }
        if (auth('teacher')->check()) {
            Auth::setDefaultDriver("teacher");
        } else {
            return redirect('/')->with('error', "You don't have access.");
        }
        return $next($request);
    }
}
