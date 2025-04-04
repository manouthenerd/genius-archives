<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if(Auth::guard('member')->check() || Auth::check()) {

            if($request->user('member') && $request->user('member')->status !== 'enable') {
                Auth::guard('member')->logout();
                header("Location: /");
                return redirect('/connexion');
            } else {

                return $next($request);
            } 

            if($request->user() && $request->user()->status !== 'enable') {
                Auth::logout();
                header("Location: /");
                return redirect('/connexion');
            }else {

                return $next($request);
            } 
            
        }

        return redirect('/connexion');
        
    }
}
