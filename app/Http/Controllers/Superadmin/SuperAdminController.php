<?php

namespace App\Http\Controllers\Superadmin;

use App\Models\User;
use Inertia\Inertia;
use Inertia\Response;
use App\Http\Controllers\Controller;
use App\Models\AccessKey;
use App\Models\Member;

class SuperAdminController extends Controller
{
    public function index(): Response
    {
        $admins     = User::where('role', '=', 'administrateur')->paginate(10);
        $keys       = AccessKey::paginate(10);
        $members    = Member::paginate(10);
        
        return Inertia::render('Superadmin/Home', [
            'members'   => $members,
            'keys'      => $keys,
            'admins'    => $admins
        ]);
    }
}
