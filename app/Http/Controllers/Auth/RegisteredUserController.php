<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterUserRequest;
use App\Models\AccessKey;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Inertia\Inertia;
use Inertia\Response;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(RegisterUserRequest $request): RedirectResponse
    {
        
        $validated = $request->validated();

        $access_key = AccessKey::where('key', '=', $validated['access_key'])->first();

        if( $access_key->user_id !== null) {
            
            return redirect()->back()->withErrors("La clé d'accès a été déjà utilisée", 'incorrect_key');
        }

        $user = User::create([
            'name'      => $validated['name'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']) ,
            'role'      => 'administrateur',
        ]);
        
        event(new Registered($user));
        
        Auth::login($user);

        $access_key->user_id = $user->id;

        $access_key->save();

        return redirect(route('dashboard', absolute: false));


    }
}
