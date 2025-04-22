<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Inertia\Inertia;
use App\Models\MemberFolder;
use App\Models\UserFolder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FolderController extends Controller
{

    public function show($id, Request $request)
    {

        $folder = [];

        $files = [];

        if ($request->user()) {
            $folder = UserFolder::findOrFail($id);
            $files = Archive::where('user_folder_id', '=', $id)->get();
        }

        if ($request->user('member')) {
            $folder = MemberFolder::findOrFail($id);
            $files = Archive::where('member_folder_id', '=', $id)->get();
        }

        if (! $folder) {
            return abort(404);
        }

        $files = $files->map(function ($file) {

            if (Storage::disk('public')->exists($file->file_path)) {
                (new ArchiveController)->create_temp_file($file->id);
            };

            return [
                'id'             => $file->id,
                'name'           => $file->name,
                'description'    => $file->description,
                'file_path'      => $file->file_path,
                'file_size'      => $file->file_size * 1024,
                'file_extension' => $file->extension,
                'file_type'      => $file->file_type,
                'created_at'     => $file->created_at,
                'download_path'  => "/storage/temp/$file->name.$file->extension",
            ];
        });

        return Inertia::render('Folder/Folder', [
            'files'     => $files,
            'folder'    => ['id' => $folder->id, 'name' => $folder->name]
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'          => ['required', 'string'],
            'visibility'    => ['required', 'in:private,public'],
            'access_level'  => ['required', 'in:private,public'],
        ]);

        $validated['name'] = Str::slug($validated['name']);

        if ($request->user('member')) {

            $user = $request->user('member')->id;

            $folder = Arr::add($validated, 'member_id', $user);

            MemberFolder::create($folder);
        }

        if ($request->user()) {

            $user = $request->user()->id;

            $folder = Arr::add($validated, 'user_id', $user);

            UserFolder::create($folder);
        }

        return redirect()->back();
    }

    public function delete($id)
    {

        $folder = UserFolder::find($id, ['id', 'name']);

        // $folder_path = $this->folder_name($folder->name);

        // Storage::disk('public')->deleteDirectory($folder_path);

        $folder_files = $folder->archives;

        $folder_files->map(fn($file) => $file->delete());

        $folder->delete();

        return redirect('/');
    }

    public function restore($id)
    {
        $folder = UserFolder::withTrashed()->find($id, ['id']);

        $folder->restore();

        return redirect()->back();
    }

    public function destroy($id)
    {

        $folder = UserFolder::withTrashed()->find($id, ['id', 'name']);

        $folder_path = $this->folder_name($folder->name);

        Storage::disk('public')->deleteDirectory($folder_path);

        $folder->forceDelete();

        return redirect()->back();
    }

    public function folder_name($folder)
    {
        $folder_path = "";

        if (request()->user('member')) {
            $folder_path = Str::slug(request()->user('member')->name) . "-" . request()->user('member')->id;
            $folder_path .= "/$folder";
        } else {
            $folder_path = Str::slug(request()->user()->name)  . "-" . request()->user()->id;
            $folder_path .= "/$folder";
        }

        return $folder_path;
    }

    public function delete_temporary_file($file_name)
    {
        return Storage::disk('public')->delete("storage/temp/$file_name");
    }
}