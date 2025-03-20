<?php

namespace App\Http\Controllers;

use App\Classes\OpenSsl;
use Inertia\Inertia;
use App\Models\Folder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\FileUploadRequest;
use App\Models\Archive;

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


                                    # # # # # # # # # # 
                                    # DATA CONVERSION #
                                    # # # # # # # # # #
                                    #      👾        #
                                    # 1Ko => 1024 O   #
                                    # 1Mo => 1024^2 O #
                                    # 1Go => 1024^3 O #
                                    # # # # # # # # # #


        // Récupérer la taille du fichier en MegaOctet
        $file_size = $request->file->getSize() / pow(1024, 2);

        $title = $request->validated('title');

        $description = $request->validated('description');

        $mime_type = finfo_file(finfo_open(FILEINFO_MIME), $request->file);

        $folder = Folder::find($request->validated('folder'), ['id', 'name', 'access_level', 'visibility']);

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

        //-------Processus de cryptage du contenu du fichier----------

        // Récupérer le fichier
        $file = $request->file;

        // Crypter et récupérer le contenu
        $encrypted_file_content = Crypt::encrypt(file_get_contents($request->file));

        $file_path = null;

        // Enregistrer le contenu crypté dans le même fichier
        file_put_contents($file, $encrypted_file_content);

        // Enregistrer le fichier dans le répertoire correspondant
        if ($folder['access_level'] == 'public') {
            $file_path = Storage::disk('public')
                ->putFileAs($directory_name_format . "/" . $folder->name, $file, "$title.$file_extension");
        }

        if ($folder['access_level'] == 'private') {
            $file_path = Storage::putFileAs($directory_name_format . "/" . $folder->name, $file, "$title.$file_extension");
        }

        // Enregistrer les information du fichier dans la BD
        Archive::create([
            'folder_id' => $folder->id,
            'name'      => $title,
            'description'   => $description,
            'extension'     => $file_extension,
            'mime_type'     => $mime_type,
            'file_path'     => $file_path,
            'file_size'     => $file_size
        ]);

        return redirect()->back();
    }
}
