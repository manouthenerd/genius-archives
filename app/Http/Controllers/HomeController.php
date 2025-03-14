<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Http\Controllers\Superadmin\SuperAdminController;
use App\Models\Member;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        // dd(sys_get_temp_dir());
        
        $user = $request->user('web') ?? $request->user('member');

        switch ($user->role) {
            case 'superadmin':
                return (new SuperAdminController)->index();
                break;

            default:
                
                return Inertia::render('Home');
                break;
        }
    }
}
