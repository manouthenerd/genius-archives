<?php

namespace App\Http\Controllers\Auth;

use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */

    public function __invoke(Request $request)
    {
        
        
            if($request->user()) {

                if($request->user()->hasVerifiedEmail()) {
                    return redirect()->intended(route('dashboard', absolute: false));
                }

                (new EmailVerificationNotificationController)->store($request);
                
                return Inertia::render('Auth/VerifyEmail', ['status' => session('status'), 'email' => $request->user()->email]);
            }

            if($request->user('member')) {

                if($request->user('member')->hasVerifiedEmail()) {
                    return redirect()->intended(route('dashboard', absolute: false));
                }

                (new EmailVerificationNotificationController)->store($request);

                return Inertia::render('Auth/VerifyEmail', ['status' => session('status'), 'email' => $request->user('member')->email]);
            }
    }
}
