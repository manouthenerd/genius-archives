<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function create()
    {

        return Inertia::render('Archives/CreateArchive');
    }

    public function store(Request $request)
    {
        // dd($request->file('doc')->store());

        $file = $request->file('doc');

        $file->store('temp', 'temp');
        return Inertia::render('Archives/CreateArchive');
    }

}
