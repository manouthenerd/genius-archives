<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Folder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FolderController extends Controller
{
    public function show($id)
    {
        $folder = Folder::findOrFail($id);

        if(! $folder) {
            return abort(404);
        }

       $files = $folder->archives;

       $files = $files->map( function($file) {

        (new ArchiveController)->create_temp_file($file->id);

            return [
                'id'            => $file->id,
                'name'          => $file->name,
                'description'   => $file->description,
                'file_path'     => $file->file_path,
                'file_size'     => $file->file_size * 1024,
                'file_extension'=> $file->extension,
                'file_type'     => $file->file_type,
                'created_at'    => $file->created_at,
                'download_path' => "/storage/temp/$file->name.$file->extension",
            ];
       });
    
       return Inertia::render('Folder/Folder', [
        'files' => $files,
        'folder'    => $folder->name
       ]);
     
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => ['required', 'string'],
            'visibility'    => ['required', 'in:private,public'],
            'access_level'  => ['required', 'in:private,public'],
            'password'      => ['required_if:access,private']
        ]);

        $validated['name'] = Str::slug($validated['name']);

        $user = $request->user('member')->id ?? $request->user()->id;

        $folder = Arr::add($validated, 'owner_id', $user);

        Folder::create($folder);

        return redirect()->back();
    }
}
