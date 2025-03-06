<?php

namespace Database\Seeders;

use App\Models\Member;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Member::factory()->create([
        //     'name'      => 'Manou 👾',
        //     'user_id'   => 3,
        //     'email'     => 'test@gmail.com',
        //     'password'  => Hash::make('%n=rvE}2rvu:TEB'),
        //     'role'      => 'utilisateur'
        // ]);

        // User::factory()->create([
        //     'name'      => 'Genius Admin',
        //     'email'     => 'info@geniusntech.com',
        //     'password'  => Hash::make('password'),
        //     'role'      => 'superadmin'
        // ]);

        // User::factory()->create([
        //     'name'      => 'Geek Space',
        //     'email'     => 'geekspace@gmail.com',
        //     'password'  => Hash::make('password'),
        //     'role'      => 'administrateur'
        // ]);

    }
}
