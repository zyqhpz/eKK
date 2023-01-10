<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            'name' => 'Kelab A',
            'role' => 1,
            'email' => 'kelab.a@volt.com',
            'password' => Hash::make('secret'),
        ]);

        DB::table("users")->insert([
            'name' => 'Kelab B',
            'role' => 1,
            'email' => 'kelab.b@volt.com',
            'password' => Hash::make('secret'),
        ]);

        DB::table("users")->insert([
            'name' => 'Admin User',
            'role' => 0,
            'email' => 'admin@volt.com',
            'password' => Hash::make('secret'),
        ]);
    }
}
