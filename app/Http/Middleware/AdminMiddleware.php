<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }

        if (!Auth::user()->hasRole('admin') && !Auth::user()->hasRole('teacher')) {
            return redirect()->route('home')->with('error', 'Access denied. Admin or Teacher privileges required.');
        }

        return $next($request);
    }
}
