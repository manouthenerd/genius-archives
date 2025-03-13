<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        
        if ($request->user()) {

            if ($request->user()->hasVerifiedEmail()) {
                return redirect()->intended(route('dashboard', absolute: false));
            }
            $request->user()->sendEmailVerificationNotification();
        }

        if ($request->user('member')) {
            
            if ($request->user('member')->hasVerifiedEmail()) {
                return redirect()->intended(route('dashboard', absolute: false));
            }
            $request->user('member')->sendEmailVerificationNotification();
        }

        return back()->with('status', 'verification-link-sent');
    }
}
