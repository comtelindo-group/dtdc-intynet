<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserStatusMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth()->user()->status) {
            auth()->logout();

            return response()->json([
                'code' => 403,
                'status' => 'fail',
                'message' => 'Your account has been disabled'
            ]);
        }

        return $next($request);
    }
}
