<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Folder;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Superadmin\SuperAdminController;
use App\Models\AccessKey;
use App\Models\Member;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        // Récupérer le type d'utilisateur emettant la requête
        $user = $request->user('web') ?? $request->user('member');

        // Récupérer les dossiers du User connecté
        $folders = Folder::where('owner_id', '=', $user->id)->get('id');

        // Récupérer l'Id de chaque dossier
        $folders_id = $folders->map(function ($folder) {
            return $folder->id;
        });

        // Transformer le tableau en string séparé par des ','
        $folders_id = Arr::join($folders_id->toArray(), ',');

        $files_by_type = null;

        // Récupérer le quota d'espace associé à chaque membre
        $members_disk_space = [];

        $user_disk_space = null;

        if($request->user()) {

            $auth_admin_id = $request->user()->id;

            $members_disk_space = DB::select("
                select disk_space * 1024 AS disk_space, COUNT(id) AS total 
                FROM members where user_id = ?
                GROUP BY(disk_space)
            ", [$auth_admin_id]);

            $user_disk_space = $request->user()->access_key->disk_space;
            
        }

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
                    'members_disk_space' => $members_disk_space,
                    'user_disk_space'    => $user_disk_space
                ]);

                break;
        }
    }
}
