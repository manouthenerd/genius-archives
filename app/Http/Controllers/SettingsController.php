<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        $user_role = $request->user()->role ?? $request->user('member')->role;

        return $user_role == 'superadmin'
            ? Inertia::render('Superadmin/Settings', [])
            : Inertia::render('Settings', []);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'current_password' => 'nullable|string|min:8',
            'password' => 'nullable|string|min:8|confirmed',
            'password_confirmation' => 'nullable|string|min:8',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048', // Limite de 2 Mo
        ]);

        $user = $request->user();

        $member = $request->user('member');

        if($user) {

            
            $current_password = $request->current_password;
            $new_password = $request->pasword;
            
            if($current_password) {
                if(! Hash::check($current_password, $user->password)) {
                    return redirect()->back()->withErrors('Le mot de passe entré est incorrect');
                }

                $user->password = Hash::make($new_password);

            }

            $user->name = $request->username;

            $user->save();

            return redirect()->to('/parametres');


        }


    }
}
