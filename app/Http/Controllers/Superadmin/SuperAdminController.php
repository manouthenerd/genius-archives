<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use App\Models\AccessKey;
use App\Models\Member;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class SuperAdminController extends Controller
{
    public function index()
    {
        $admin     = User::where('role', '=', 'administrateur')->first(['id', 'name', 'email', 'role']);
        $key       = AccessKey::where('disk_space', '>', 1)->first(['id', 'key', 'disk_space', 'user_id']);
        $member    = Member::where('user_id', '>', 1)->first(['id', 'user_id', 'name', 'email', 'role', 'disk_space']);

        $admin = $admin ? $admin->toArray() : [];

        if ($admin) {

            $user_key_id = AccessKey::where('user_id', '!=', null)->value('id');

            $member_admin = "";
            
            if($member) {
                $member_admin = User::where('id', '=', $member->user_id)->first(['id', 'name']);
            }

            $admin['access_key'] = $user_key_id;

            $member['admin'] = $member_admin;
        }


        return Inertia::render('Superadmin/Home', [
            'member'    => $member ?? [],
            'access_key' => $key ?? [],
            'admin'     => $admin ?? []
        ]);
    }
}
