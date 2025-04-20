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
        if (auth()->check()) {
            $user = auth()->user();
            
            if ($user->isGuest() && !$request->is('guest*')) {
                return redirect()->route('guest.home');
            }
            
            if ($user->isUser() && !$request->is('user*')) {
                return redirect()->route('user.home');
            }
        }

        return $next($request);
    }
}