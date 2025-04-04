<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\AccessKey;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\AccessKeysRequest;
use App\Jobs\DeleteAllFromUser;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class AccessKeysController extends Controller
{
    public function index()
    {

        return Inertia::render('Superadmin/AccessKeys', [

            'access_keys'  => AccessKey::paginate(20)
        ]);
    }

    public function create()
    {
        define('ACCESS_KEY', Str::uuid());
        
        return Inertia::render('Superadmin/CreateAccessKey', ['access_key' => ACCESS_KEY]);
    }

    public function edit($id)
    {
        $access_key = AccessKey::find($id, ['key', 'disk_space']);
        
        return Inertia::render('Superadmin/EditAccessKey', ['access_key' => $access_key]);
    }

    public function update($id, Request $request): RedirectResponse
    {
        $request->validate([
            'key'           => ['required', 'string', 'min:36', 'max:36', 'uuid', Rule::unique('access_keys', 'key')->ignore($id)],
            'disk_space'    => ['required', 'integer', 'numeric', 'gt:0']
        ]);

        $access_key = AccessKey::findOrFail($id);

        $access_key->disk_space = $request->input('disk_space');

        $access_key->save();

        return redirect()->back();

        
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

    public function destroy($id, Request $request)
    {
        if(! $request->user()->role == 'superadmin') {
            return abort(403);
        }

        $access_key = AccessKey::findOr($id, fn() => abort(404));

        $user = $access_key->user;

        DeleteAllFromUser::dispatch($user);

        $access_key->delete();
        
    }
}
