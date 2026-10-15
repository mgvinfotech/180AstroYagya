<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->check()) {
            return redirect()->route('admin.login')->with('error', 'Please login to access the administration sanctuary.');
        }

        if (!auth()->user()->isAdmin()) {
            auth()->logout();
            return redirect()->route('admin.login')->with('error', 'Unauthorized access. Admin privileges required.');
        }

        return $next($request);
    }
}
