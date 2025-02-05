<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'name'       => 'Admin',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Reviewer',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name'       => 'Attempter',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}