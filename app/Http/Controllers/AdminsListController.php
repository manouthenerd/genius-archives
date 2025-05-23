<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Folder;
use App\Models\Archive;
use App\Models\AccessKey;
use App\Models\UserFolder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminsListController extends Controller
{
    public function index()
    {
        
        $admins = User::where('role', '=', 'administrateur')->get(['id', 'name', 'email', 'created_at']);

        $admins = $admins->map( function($admin) {
            $members_folders_id = $admin->members()->pluck('id');

            $folders        = UserFolder::where('user_id', '=', $admin->id)->pluck('id');
            $archives_size  = Archive::whereIn('folder_id', $folders)->sum('file_size');
            $total_space    = AccessKey::where('user_id', '=', $admin->id)->value('disk_space');
            $members_files_size = Archive::whereIn('folder_id', $members_folders_id);

            return [
                'id' => $admin->id,
                'name' => $admin->name,
                'email' => $admin->email,
                'disk_space' => $total_space,
                'archives_size' => $archives_size,
                'created_at' => $admin->created_at,
                'members' => $admin->members()->count(),
                'archives' => Archive::whereIn('folder_id', $folders)->count(),
                'folders' => UserFolder::where('user_id', '=', $admin->id)->count(),
            ];
        });

        return Inertia::render('Superadmin/Admins', ['admins' => $admins]);
    }

    public function destroy($id)
    {
        $user = User::find($id);

        $user->status = "disable";
        
        $user->save();

        return redirect()->back();

    }
}
