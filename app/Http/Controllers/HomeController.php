<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Superadmin\SuperAdminController;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user()->role;

        switch ($user) {
            case 'superadmin':
                return (new SuperAdminController)->index();
                break;

            default:
                return Inertia::render('Home');
                break;
        }
    }
}
