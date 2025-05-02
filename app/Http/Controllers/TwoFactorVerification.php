<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Member;
use Illuminate\Support\Facades\Mail;
use App\Mail\Send2faVerificationCode;

class TwoFactorVerification extends Controller
{
    public static function generateTwoFactorCode(User|Member $user)
    {
        $user->two_factor_code = rand(1000, 9999);
        $user->two_factor_expires_at = now()->addMinutes(15);
        $user->save();

        Mail::to($user->email)->send(new Send2faVerificationCode($user->name, $user->two_factor_code));
    }
    

    /**
     * Reset the two-factor authentication code and expiration.
     *
     * @param User|Member $user The user whose two-factor code will be reset.
     * @return void
     */
    public static function resetTwoFactorCode(User|Member $user)
    {

        $user->two_factor_code = rand(1000, 9999);
        $user->two_factor_expires_at = now()->next("01:30");
        $user->save();
    }
}
