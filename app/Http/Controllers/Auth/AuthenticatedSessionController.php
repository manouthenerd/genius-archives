<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\MemberSession;
use App\Models\UserSessions;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {

        // (new DiskSpace)->admin_members_disk_space(2);

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

            $session_id = $request->session()->get('member_session_id');

            $user_session = MemberSession::find($session_id);

            $user_session->logout_at = now()->format('Y-m-d h:i');
            $user_session->status = 'offline';

            $user_session->save();

            Auth::guard('member')->logout();
        }

        if ($request->user()) {

            $session_id = $request->session()->get('user_session_id');

            if ($session_id) {
                
                $user_session = UserSessions::find($session_id);

                $user_session->logout_at = now()->format('Y-m-d h:i');
                $user_session->status = 'offline';

                $user_session->save();
            }

            Auth::logout();
        }

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/connexion');
    }
}
