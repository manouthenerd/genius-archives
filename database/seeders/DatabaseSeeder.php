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
            'name'      => 'Genius Admin',
            'email'     => 'info@geniusntech.com',
            'password'  => Hash::make('password'),
            'role'      => 'superadmin',
            'email_verified_at' => now()
        ]);

        User::factory()->create([
            'name'              => 'Manou Thenerd',
            'email'             => 'manouthenerd@gmail.com',
            'password'          => Hash::make('password'),
            'role'              => 'administrateur',
            'email_verified_at' => NULL
        ]);

        Member::factory()->create([
            'name'                      => 'Jhon Doe',
            'user_id'                   => 2,
            'email'                     => 'jhondoe@gmail.com',
            'password'                  => Hash::make('password'),
            'role'                      => 'member',
            'disk_space'                => 0.5,
            'can_view_private_folders'  => true
        ]);

        AccessKey::factory()->create([
            'key'           => Str::uuid(),
            'user_id'       => 2,
            'disk_space'    => 2,
        ]);

    }
}
