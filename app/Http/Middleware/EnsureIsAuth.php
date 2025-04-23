<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DeleteAllFromUser;
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

        if (Auth::guard('member')->check()) {

            if ($request->user('member')->status !== 'enable') {
                Auth::guard('member')->logout();
                return redirect('/connexion');
            }

            return $next($request);
        }

        if (Auth::check()) {

            if ($request->user()->status == 'disable') {

                $user = User::find($request->user()->id);

                Auth::logout();

                (new DeleteAllFromUser)->execute($user);

                return redirect('/connexion');
            }

            return $next($request);
        }

        return redirect('/connexion');
        
    }
}
