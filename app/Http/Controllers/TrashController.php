<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Folder;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Member;
use App\Models\UserFolder;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TrashController extends Controller
{

    public function index(Request $request)
    {

        $user_role = $request->user()->role;

        // $superadmin = $request->user()->role == 'superadmin' ? $request->user() : [];
        $admin = $request->user()->role == 'administrateur' ? $request->user() : [];

        $trashed_archives = [];
        $trashed_folders = [];
        $trashed_members = [];

        if ($admin) {
            // Membres et dossiers supprimés par l'admin
            $trashed_members  = Member::onlyTrashed()->where('user_id', '=', $admin->id)->get(['id', 'name', 'email', 'deleted_at']);
            // $trashed_folders  = UserFolder::onlyTrashed()->where('user_id', '=', $admin->id)->get(['id', 'name', 'deleted_at']);

            $admin_folders = UserFolder::where('user_id', '=', $admin->id)->get(['id', 'name', 'user_id']);

            $trashed_archives = $admin_folders->map(function ($folder) {

                return [
                    'user' => User::find($folder->user_id, 'name'),
                    'archives' => Archive::onlyTrashed()
                        ->where('user_folder_id', '=', $folder->id)
                        ->get(['id', 'name', 'deleted_at', 'extension'])
                ];
            });

            // dd($trashed_archives);

            $trashed_archives = $trashed_archives->map(function ($archive) {

                return $archive['archives']->map(function ($item) use ($archive) {

                    return [
                        'id'        => $item->id,
                        'user'      => $archive['user']->name,
                        'name'      => $item->name,
                        'deleted_at' => $item->deleted_at,
                        'extension' => $item->extension,
                    ];
                });
            });
        }

        return $user_role == 'superadmin'

            ? Inertia::render('Superadmin/Trash', [])

            : Inertia::render('Trash', [

                'trashed_members' => $trashed_members,
                'trashed_folders' => $trashed_folders,
                'trashed_archives' => Arr::collapse($trashed_archives)
            ]);
    }

}
