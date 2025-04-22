<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class DeleteAllFromUser extends Controller
{
    protected User $user;

    public function execute(User $user)
    {
        $this->user = $user;
        
        // Récupérer les dossiers de l'admin
        $admin_folders = $this->user->folders;

        // Récupérer les archives des différents dossiers
        $admin_archives = $admin_folders->map(function ($folder) {
            return $folder->archives;
        });

        $admin_archives = $admin_archives->collapse();

        // Supprimer tous les membres et leurs différents fichiers
        $members = $this->user->members;

        // Suppression des éléments récupérés
        function deleteTarget($target)
        {
            $target->forceDelete();
        }

        if ($members) {

            // Récupérer les différents dossiers des membres
            $members_folders = $members->map(function ($member) {
                return $member->folders;
            });

            $members_folders = $members_folders->collapse();

            // Récupérer les archives contenus dans les dossiers
            $members_archives = $members_folders->map(function ($folder) {
                return $folder->archives;
            });

            $members_archives = $members_archives->collapse();

            // 1-suppression des fichiers des membres
            $members_archives->map(fn($archive) => deleteTarget($archive));

            // Supprimer les archives des membres en base de données et en physique
            $members_archives->map(function ($archive) {
                Storage::disk('public')->delete($archive->file_path);
                Storage::disk('public')->delete("temp/$archive->name.$archive->extension");
            });

            // 2-suppression des membres
            $members->map(function ($member) {

                $directory_name = Str::slug($member->name) . "-$member->id";

                // a-Mettre le status des membres à "disable" pour la déconnexion auto
                $member->status = 'disable';
                $member->save();
                Storage::disk('public')->deleteDirectory($directory_name);
            });

            // Supprimer maintenant les membres sans déclencher de bugs
            $members->map(fn($member) => deleteTarget($member));
        }

        // 1-suppression des dossiers
        $admin_folders->map(fn($folder) => deleteTarget($folder));

        // Supprimer les archives des membres en base de données et en physique
        $admin_archives->map(function ($archive) {
            Storage::disk('public')->delete($archive->file_path);
            Storage::disk('public')->delete("temp/$archive->name.$archive->extension");
            deleteTarget($archive);
        });

        $user_id = $this->user->id;

        // 3-suppression des données de l'admin associés à la clé
        $directory_name = Str::slug($this->user->name) . "-" . $user_id;

        // a-Mettre le status des membres à "disable" pour la déconnexion auto
        $this->user->status = 'disable';
        $this->user->save();

        Storage::disk('public')->deleteDirectory($directory_name);
    }
}
