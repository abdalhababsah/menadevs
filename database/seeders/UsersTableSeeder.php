<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // It's assumed that the roles have been inserted in this order:
        // 1 => Admin, 2 => Reviewer, 3 => Attempter
        DB::table('users')->insert([
            [
                'first_name'         => 'Admin',
                'last_name'          => 'User',
                'email'              => 'admin@example.com',
                'role_id'            => 1,
                'password'           => Hash::make('password'), // Change the password as needed
                'email_verified_at'  => now(),
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'first_name'         => 'Reviewer',
                'last_name'          => 'User',
                'email'              => 'reviewer@example.com',
                'role_id'            => 2,
                'password'           => Hash::make('password'), // Change the password as needed
                'email_verified_at'  => now(),
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
            [
                'first_name'         => 'Attempter',
                'last_name'          => 'User',
                'email'              => 'attempter@example.com',
                'role_id'            => 3,
                'password'           => Hash::make('password'), // Change the password as needed
                'email_verified_at'  => now(),
                'created_at'         => now(),
                'updated_at'         => now(),
            ],
        ]);
    }
}