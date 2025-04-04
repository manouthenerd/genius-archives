<?php

namespace App\Classes;

use App\Models\Member;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DiskSpace
{

    public function admin_members_disk_space($admin_id)
    {   
        // Calculer le total des fichiers uploadés par l'admin
        // Calculer le total des fichiers des membres de l'admin

        $user_members_disk_space = Member::where('user_id', '=', $admin_id)->sum('disk_space');

        $members = User::find($admin_id, ['id', 'name'])
            ->members()
            ->get(['id', 'name'])
            ->toArray();

        // $folders = $members->map( function($member) {
        //     return Folder::where('owner_id', '=', $member->id)->get(['id', 'name']);
        // });

        $members_id = Arr::map($members, function($member) {
            return $member['id'];
        });

    }   
}
