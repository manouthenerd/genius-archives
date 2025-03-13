<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\AccessKey;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\AccessKeysRequest;
use Illuminate\Http\RedirectResponse;

class AccessKeysController extends Controller
{
    public function index()
    {

        return Inertia::render('Superadmin/AccessKeys', [

            'access_keys'  => AccessKey::paginate(20)
                // ->get('id', 'user_id', 'key', 'lifetime', 'disk_space')
        ]);
    }

    public function create()
    {
        define('ACCESS_KEY', Str::uuid());
        
        return Inertia::render('Superadmin/CreateAccessKey', ['access_key' => ACCESS_KEY]);
    }

    public function store(AccessKeysRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $isValidUuid = Str::isUuid($validated['key']);

        if(! $isValidUuid) {
            return redirect()->back()->with('fail', "La clé d'accès est invalide");
        }

        AccessKey::create($validated);

        return redirect()->route('access-keys.create')->with('success', "Clé d'accès générée avec succès");

        
    }
}
