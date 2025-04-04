<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Member;
use App\Models\AccessKey;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        

        User::factory()->create([
            'name'      => 'Genius Superadmin',
            'email'     => 'info@geniusntech.com',
            'password'  => Hash::make('password'),
            'role'      => 'superadmin',
            'email_verified_at' => now()
        ]);

    }
}
