<?php

namespace App\Classes;

use App\Models\User;
use Illuminate\Support\Facades\DB;

class UsersStatus
{
    /**
     * Récupère les informations liées aux membres créés par l'admin actuel
     */
    public static function get()
    {
        $users = User::all(['id', 'name', 'email']);

        $users_history = $users->map(function ($user) {

                return [
                    'name'  => $user->name,
                    'email' => $user->email,
                    'session_id' => static::get_user_session($user->id, 'id'),
                    'status' => static::get_user_session($user->id, 'status'),
                    'ip_address' => static::get_user_session($user->id, 'ip_address'),
                    'login_at' => static::get_user_session($user->id, 'login_at'),
                    'logout_at' => static::get_user_session($user->id, 'logout_at'),
                ];
            
        });

        return $users_history->filter(function ($value) {
            return $value !== null;
        });
    }

    public static function get_user_session(int $id, $column)
    {
        return DB::table('user_sessions')->where('user_id', '=', $id)->orderByDesc('created_at')->value($column);
    }
}
