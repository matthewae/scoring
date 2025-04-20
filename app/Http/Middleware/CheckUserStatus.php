<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Skip middleware checks for authentication routes and home
        if ($request->is('login*') || $request->is('register*') || $request->is('logout*') || $request->is('home')) {
            return $next($request);
        }

        if (auth()->check()) {
            $user = auth()->user();
            
            // Block access if user is trying to access wrong section
            if ($user->isGuest() && !$request->is('guest*')) {
                abort(403, 'Access denied. Guest users can only access guest section.');
            }
            
            if ($user->isUser() && !$request->is('user*')) {
                abort(403, 'Access denied. Regular users can only access user section.');
            }
        }
    
        return $next($request);
    }    
}