<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VerifiedEmail
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        if($request->user()) {

            return $request->user()->email_verified_at ? $next($request) : redirect('/verification-email');
        }

        if($request->user('member')) {

            return $request->user('member')->email_verified_at ? $next($request) : redirect('/verification-email');
        }
        
    }
}
