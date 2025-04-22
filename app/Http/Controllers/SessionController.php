<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Member;
use App\Models\UserSessions;
use App\Models\MemberSession;

class SessionController extends Controller
{
    public static function get_user_last_session(User $user)
    {
        $user_session = UserSessions::where('user_id', '=', $user->id)->get(['login_at'])->last();

        $user_last_session = $user_session ? explode(' ', $user_session->login_at)[0] : null;

        return $user_last_session;
    }

    public static function get_member_last_session(Member $member)
    {
        $member_session = MemberSession::where('member_id', '=', $member->id)->get(['login_at'])->last();

        $member_last_session = $member_session ? explode(' ', $member_session->login_at)[0] : null;

        return $member_last_session;
    }
}
