<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Member;
use Illuminate\Http\Request;

class MembersListController extends Controller
{
    public function index()
    {

        $members = Member::all(['id', 'name', 'email', 'created_at']);

        $members = $members->map( function($member) {
            return [
                'id' => $member->id,
                'name' => $member->name,
                'email' => $member->email,
                'created_at' => $member->created_at,
            ];
        });

        return Inertia::render('Superadmin/Members', ['members' => $members]);
    }
}
