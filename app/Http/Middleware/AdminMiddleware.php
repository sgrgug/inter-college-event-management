<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
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
        // Check if the user is logged in and has an 'admin' role.
        if ($request->user() && $request->user()->role === 'admin') {
            return $next($request);
        }

        // Redirect or return an error response if the user is not an admin.
        return redirect()->route('home')->with('error', 'Access Denied: You must be an admin.');
    }
}
