<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;

class TrashController extends Controller
{

    public function index(Request $request)
    {
        $user_role = $request->user()->role;

        return $user_role == 'superadmin' 
            ? Inertia::render('Superadmin/Trash', []) 
            : Inertia::render('Trash', []) ;
    }

}
