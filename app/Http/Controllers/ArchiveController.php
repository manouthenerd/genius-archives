<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Folder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FileUploadRequest;

class ArchiveController extends Controller
{
    public function create(Request $request)
    {

        $user = null;

        if ($request->user('member')) {
            $user = $request->user('member');
        } else {
            $user = $request->user();
        }

        $folders = Folder::where('owner_id', '=', $user->id)->get(['id', 'name', 'access_level', 'visibility']);

        $folders = $folders->map(function ($folder) {
            $folder->name = str_replace('-', ' ', $folder->name);
            return $folder;
        });

        return Inertia::render('Archives/CreateArchive', ['folders' => $folders]);
    }

    public function store(FileUploadRequest $request): RedirectResponse
    {
        if (! $request->file('file')->isValid()) {
            return redirect()->back()->with('status', "Une erreur s'est produit lors du téléversement");
        }
        // Récupérer la taille du fichier en GigaOctet
        $file_size = $request->file->getSize() / pow(1024, 3);

        $title = $request->validated('title');

        $content = $request->validated('content');
        $encryption_key = $request->validated('encryption_key');

        $folder = Folder::find($request->validated('folder'))
            ->only('id', 'name', 'access_level', 'visibility');

        $file_extension = $request->file->extension();

        $user = request()->user() ?? request()->user('member');

        $directory_name_format = Str::slug($user->name . "-$user->id");

        // Créer un un répertoire privé au nom du User si non existant
        if (Storage::directoryMissing($directory_name_format)) {
            Storage::makeDirectory($directory_name_format);
        }

        // Créer un un répertoire public au nom du User si non existant
        if (! in_array($directory_name_format, Storage::disk('public')->directories())) {
            Storage::disk('public')->makeDirectory($directory_name_format);
        }

        $file_path = null;

        // Enregistrer le fichier dans: User_name/folder/nom_unique
        if ($folder['access_level'] == 'public') {
            $file_path = Storage::disk('public')
                ->put("$directory_name_format/" . $folder['name'], $request->file);
        }

        if ($folder['access_level'] == 'private') {
            $file_path = Storage::put("$directory_name_format/" . $folder['name'], $request->file);
        }


        return redirect()->back();
    }
}
