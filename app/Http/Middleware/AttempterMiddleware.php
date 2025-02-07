<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AttempterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated and has role_id of 3 (Tasker/Attempter)
        if (auth()->check() && auth()->user()->role_id == 3) {
            return $next($request);
        }

        abort(403, 'Unauthorized access');
    }
}
