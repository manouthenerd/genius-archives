<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Superadmin\SuperAdminController;
use App\Models\Archive;
use App\Models\Folder;
use App\Models\Member;
use Illuminate\Support\Arr;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        
        $user = $request->user('web') ?? $request->user('member');

        // Récupérer les dossiers du User connecté
        $folders = Folder::where('owner_id', '=', $user->id)->get(['id', 'name']);
        
        // Récupérer l'Id de chaque dossier
        $folders_id = $folders->map( function ($folder) {
            return $folder->id;
        });

        // Récupérer les fichiers associés aux différents dossiers
        $user_files = Archive::all('id', 'folder_id', 'name', 'extension')
            ->whereIn('folder_id', $folders_id)
            ->groupBy('extension');


        
        $files_by_extension = $user_files->map( function($file) {
            return $file->count();
        });        

        switch ($user->role) {
            case 'superadmin':
                return (new SuperAdminController)->index();
                break;

            default:
                
                return Inertia::render('Home', ['files_by_extension' => $files_by_extension]);
                break;
        }
    }
}
