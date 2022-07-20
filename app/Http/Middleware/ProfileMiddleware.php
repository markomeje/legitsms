<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use App\Models\{User, Profile};
use Closure;

class ProfileMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (empty(auth()->user()->profile)) {
            if (strtoupper($request->method()) === 'GET') {
                die(view('user.profile.index'));
            }
        }

        return $next($request);
    }
}
