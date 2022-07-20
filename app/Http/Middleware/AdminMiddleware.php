<?php

namespace App\Http\Middleware;
use Illuminate\Http\Request;
use App\Models\User;
use Closure;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ('admin' === auth()->user()->role) {
            return $next($request);
        }

        return route('login');
    }
}
