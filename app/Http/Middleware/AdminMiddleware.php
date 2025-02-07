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
        // Check if the user is authenticated and has role_id of 1 (Admin)
        if (auth()->check() && auth()->user()->role_id == 1) {
            return $next($request);
        }

        abort(403, 'Unauthorized access');
    }
}