<?php

namespace App\Http\Controllers;

use App\Classes\MembersStatus;
use Inertia\Inertia;
use Illuminate\Http\Request;


class HistoryController extends Controller
{
    public function index(Request $request)
    {
        $auth_user_id = $request->user() ? $request->user()->id : null;

        $members_history = MembersStatus::get($auth_user_id);

        return Inertia::render('History', ['members_history' => $members_history]);
    }

    // public function get_member_session(int $id, $column)
    // {
    //     return DB::table('member_sessions')->where('member_id', '=', $id)->value($column);
    // }

    // public function get_user_session(int $id, $column)
    // {
    //     return DB::table('user_sessions')->where('user_id', '=', $id)->value($column);
    // }
}
