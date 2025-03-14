<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use App\Models\Folder;
use App\Models\User;
use Inertia\Inertia;
use App\Models\Member;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class TrashController extends Controller
{

    public function index(Request $request)
    {
        $user_role = $request->user()->role;

        $superadmin = $request->user()->role == 'superadmin' ? $request->user() : [];
        $admin = $request->user()->role == 'administrateur' ? $request->user() : [];

        $members = Member::onlyTrashed()->where('user_id', '=', $admin->id)->get();
        $folders = Folder::onlyTrashed()->where('owner_id', '=', $admin->id)->get();
        $archives = Archive::onlyTrashed()->where('folder_id', '=', $admin->id)->get();

        return $user_role == 'superadmin' 
            ? Inertia::render('Superadmin/Trash', []) 
            : Inertia::render('Trash', [
                
                'deleted_members' => $members,
                'deleted_folders' => $folders,
            ]) ;
    }

}
