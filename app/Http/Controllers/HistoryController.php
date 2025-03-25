<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\LoginSession;
use Illuminate\Http\Request;
use App\Models\LogoutSession;
use App\Models\Member;
use App\Models\User;
use App\Models\UserSessions;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $auth_user_id = $request->user() ? $request->user()->id : null;

        $members = User::find($auth_user_id)->members()->get(['id', 'name', 'email']);

        $members_history = $members->map(function ($member) {

            

            if ((bool) $this->get_user_session($member->id, 'id')) {

                return [
                    'name'  => $member->name,
                    'email' => $member->email,
                    'session_id' => $this->get_user_session($member->id, 'id'),
                    'status' => $this->get_user_session($member->id, 'status'),
                    'ip_address' => $this->get_user_session($member->id, 'ip_address'),
                    'login_at' => $this->get_user_session($member->id, 'login_at'),
                    'logout_at' => $this->get_user_session($member->id, 'logout_at'),
                ];
            }

        });


        return Inertia::render('History', ['members_history' => $members_history]);
    }

    public function get_user_session(int $id, $column)
    {
        return DB::table('user_sessions')->where('user_id', '=', $id)->value($column);
    }
}
