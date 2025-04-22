<?php

namespace App\Http\Middleware;

use App\Http\Controllers\SessionController;
use App\Http\Controllers\TwoFactorVerification;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TwoFactorVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if ($request->user()) {

            $user = $request->user();

            $current_date = now()->toDateString();

            $user_last_session = SessionController::get_user_last_session($user);

            if ($user_last_session) {
                if ($user_last_session !== $current_date) {
                    TwoFactorVerification::generateTwoFactorCode($user);
                    return redirect()->route('2fa.index');
                }
            }
        }

        if ($request->user('member')) {

            $member = $request->user('member');

            $current_date = now()->toDateString();

            $member_last_session = SessionController::get_member_last_session($member);
            
            if ($member_last_session) {
                if ($member_last_session !== $current_date) {
                    TwoFactorVerification::generateTwoFactorCode($member);
                    return redirect()->route('2fa.index');
                }
            }
        }

        return $next($request);
    }
}
