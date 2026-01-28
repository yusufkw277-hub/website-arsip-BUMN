<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class LoginMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!session()->has('login')) {
            return redirect('/')->with('error', 'Silakan login dulu');
        }

        return $next($request);
    }
}