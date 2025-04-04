<?php

namespace App\Classes;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class MembersStatus
{
    /**
     * Récupère les informations liées aux membres créés par l'admin actuel
     */
    public static function get(int $user_id)
    {
        $members = User::find($user_id)->members()->get(['id', 'name', 'email']);

        $members_history = $members->map(function ($member) {

            $member_session_id = static::get_member_session($member->id, 'id');

            if ((bool) $member_session_id) {

                return [
                    'name'  => $member->name,
                    'email' => $member->email,
                    'session_id' => static::get_member_session($member->id, 'id'),
                    'status' => static::get_member_session($member->id, 'status'),
                    'ip_address' => static::get_member_session($member->id, 'ip_address'),
                    'login_at' => static::get_member_session($member->id, 'login_at'),
                    'logout_at' => static::get_member_session($member->id, 'logout_at'),
                ];
            }
        });

        return $members_history->filter(function ($value) {
            return $value !== null;
        });
    }

    public static function get_member_session(int $id, $column)
    {
        // $sessions = DB::select('SELECT * FROM member_sessions WHERE DATE(created_at) = CURDATE()');

        return DB::table('member_sessions')->where('member_id', '=', $id)->orderByDesc('created_at')->value($column);
    }
}
