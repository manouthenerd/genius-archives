<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class TwoFactorController extends Controller
{

    public function index()
    {
        return Inertia::render('Auth/2FA');
    }

    public function store(Request $request)
    {

        $request->validate([
            'digit1' => ['required', 'integer'],
            'digit2' => ['required', 'integer'],
            'digit3' => ['required', 'integer'],
            'digit4' => ['required', 'integer'],
        ]);


        if (Auth::user()) {
            
            $user = Auth::user();

            if ($request->input('two_factor_code') !== $user->two_factor_code) {
                return back()->withErrors(['two_factor_code' => 'Le code est incorrect.']);
            }

            if ($user->two_factor_expires_at < now()) {
                return back()->withErrors(['two_factor_code' => 'Le code a expiré.']);
            }

            TwoFactorVerification::resetTwoFactorCode($user);
        }

        if (Auth::guard('member')->user()) {

            $member = Auth::guard('member')->user();

            if ($request->input('two_factor_code') !== $member->two_factor_code) {
                return back()->withErrors(['two_factor_code' => 'Le code est incorrect.']);
            }

            if ($member->two_factor_expires_at < now()) {
                return back()->withErrors(['two_factor_code' => 'Le code a expiré.']);
            }

            TwoFactorVerification::resetTwoFactorCode($member);
        }


        return redirect()->route('dashboard');
    }


    public function generate(Request $request)
    {
        // Vérifie si l'utilisateur est authentifié
        if ($request->user()) {
            $user = $request->user();

            // Génère un nouveau code de vérification à deux facteurs
            TwoFactorVerification::generateTwoFactorCode($user);

            // Retourne une réponse JSON avec un message de succès
            return redirect()->intended();        }

        // Vérifie si un membre est authentifié via le guard 'member'
        if ($request->user('member')) {
            $member = $request->user('member');

            // Génère un nouveau code de vérification à deux facteurs pour le membre
            TwoFactorVerification::generateTwoFactorCode($member);

            // Retourne une réponse JSON avec un message de succès
            return redirect()->intended();
        }

        // Retourne une réponse d'erreur si aucun utilisateur ou membre n'est authentifié
        return redirect()->back()->with('error', 'Utilisateur non authentifié.');
    }
}