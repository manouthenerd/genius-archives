<?php

namespace App\Classes;

use App\Models\Archive;
use App\Models\Member;
use App\Models\MemberFolder;
use App\Models\User;
use App\Models\UserFolder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class DiskSpace
{

    public function user_free_disk_space($id)
    {
        // Récupérer l'admin associé à la clé
        $admin = User::find($id, ['id', 'name', 'email']);

        // Récupérer les dossiers de l'admin
        $admin_folders_id = UserFolder::where('user_id', '=', $admin->id)->get(['id']);

        // Récupérer la taille totale des fichiers uploadés par l'admin
        $admin_archives_size = Archive::whereIn('user_folder_id', $admin_folders_id)->get(['id', 'name', 'file_size'])->sum('file_size');

        // Récupérer les membres créés par l'admin
        $members = Member::where('user_id', '=', $admin->id)->get(['id', 'name']);

        // Récupérer les dossiers de l'admin
        $member_folders_id = MemberFolder::whereIn('member_id', $members->pluck('id'))->get(['id']);

        // Récupérer la taille totale des fichiers uploadés par l'admin
        $member_archives_size = Archive::whereIn('member_folder_id', $member_folders_id)->get(['id', 'name', 'file_size'])->sum('file_size');

        return $admin_archives_size + $member_archives_size;
    }
}
