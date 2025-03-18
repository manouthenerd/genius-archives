<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Folder;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class FolderController extends Controller
{
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
