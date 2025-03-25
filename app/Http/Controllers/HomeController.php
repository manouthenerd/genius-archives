<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Folder;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Superadmin\SuperAdminController;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        $user = $request->user('web') ?? $request->user('member');

        // Récupérer les dossiers du User connecté
        $folders = Folder::where('owner_id', '=', $user->id)->get('id');

        // Récupérer l'Id de chaque dossier
        $folders_id = $folders->map(function ($folder) {
            return $folder->id;
        });

        $folders_id = Arr::join($folders_id->toArray(), ',');

        $files_by_type = null;

        // Récupérer les fichiers associés aux différents dossiers
        if ($folders_id) {
            $files_by_type = DB::select(
                "SELECT file_type, COUNT(file_type) AS 'total' FROM `archives` WHERE folder_id IN($folders_id) GROUP BY(file_type); "
            );
        }



        switch ($user->role) {
            case 'superadmin':
                return (new SuperAdminController)->index();
                break;

            default:

                return Inertia::render('Home', [
                    'files_by_extension' => $files_by_type,
                ]);
                break;
        }
    }
}
