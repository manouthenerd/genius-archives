<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index(Request $request)
    {
        $user_role = $request->user()->role ?? $request->user('member')->role;

        return $user_role == 'superadmin' 
            ? Inertia::render('Superadmin/Settings', []) 
            : Inertia::render('Settings', []) ;
    }
}
