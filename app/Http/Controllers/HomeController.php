<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Superadmin\SuperAdminController;
use App\Models\Member;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        
        $user = $request->user('web') ?? $request->user('member');

        // $user_disk      = $request->user() ? User::find($user->id)->access_key : [];
        // $member_disk    = $request->user('web') ? Member::find($request->user('member')->id)->disk_space : [];
        
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
