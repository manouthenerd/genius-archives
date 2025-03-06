<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AccessKeyGeneratorController extends Controller
{
    public function __invoke()
    {
        define('ACCESS_KEY', Str::uuid());

        return Inertia::render('Superadmin/CreateAccessKey', ['access_key' => ACCESS_KEY]);
    }
}
