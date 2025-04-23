<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\TwoFactorVerification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Member;
use App\Models\MemberSession;
use App\Models\User;
use App\Models\UserSessions;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {

        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {

            $session = UserSessions::create([
                'user_id' => $request->user()->id,
                'ip_address' => $request->ip(),
                'status'    => 'online',
                'login_at'  => now()->format('Y-m-d h:i'),
                'logout_at' => null
            ]);

            $request->session()->put('user_session_id', $session->id);

            $request->session()->regenerate();

            $user = $request->user();


            $user_last_session = SessionController::get_user_last_session($user);

            if (! $user_last_session === now()->toDateString()) {

                TwoFactorVerification::generateTwoFactorCode($user);

                return redirect()->route('2fa.index');
            }


            return redirect()->intended(route('dashboard', absolute: false));
        }

        if (Auth::guard('member')->attempt($credentials)) {

            $session = MemberSession::create([
                'member_id' => $request->user('member')->id,
                'ip_address' => $request->ip(),
                'status'    => 'online',
                'login_at'  => now()->format('Y-m-d h:i'),
                'logout_at' => null
            ]);

            $request->session()->put('member_session_id', $session->id);

            $member = $request->user('member');

            $member_last_session = SessionController::get_member_last_session($member);

            if (! $member_last_session === now()->toDateString()) {
                TwoFactorVerification::generateTwoFactorCode($member);

                return redirect()->route('2fa.index');
            }

            $request->session()->regenerate();

            return redirect()->intended(route('dashboard', absolute: false));
        }

        return redirect()->back()->withErrors('Email ou mot de passe incorrect');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if ($request->user('member')) {

            $member = $request->user('member');

            $member_session = MemberSession::where('member_id', '=', $member->id)->get(['*'])->last();

            $member_session->logout_at = now()->format('Y-m-d h:i');
            $member_session->status = 'offline';

            $member_session->save();

            $member = $request->user('member');

            Auth::guard('member')->logout();

            if ($member->status == 'disable') {
                Member::find($member->id)->forceDelete();
            }
        }

        if ($request->user()) {

            $user = $request->user();

            $user_session = UserSessions::where('user_id', '=', $request->user()->id)->get(['*'])->last();

            if ($user_session) {

                $user_session->logout_at = now();
                $user_session->status = 'offline';

                $user_session->save();
            }

            Auth::logout();

            if ($user->status == 'disable') {
                User::find($user->id)->forceDelete();
            }
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/connexion');
    }
}
