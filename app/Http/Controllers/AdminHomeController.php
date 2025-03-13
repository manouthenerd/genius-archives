<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminHomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Superadmin/Home');
    }
}
