<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReviewerMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has role_id of 2 (Reviewer)
        if (auth()->check() && auth()->user()->role_id == 2) {
            return $next($request);
        }

        abort(403, 'Unauthorized access');
    }
}