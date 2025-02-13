<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =
        [
            [
                'name' => 'Admin Satu',
                'username' => 'admin1',
                'email' => 'admin1@example.com',
                'password'  => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'Admin Dua',
                'username' => 'admin2',
                'email' => 'admin2@example.com',
                'password'  => Hash::make('password'),
                'role' => 'admin',
            ],
            [
                'name' => 'User Satu',
                'username' => 'user1',
                'email' => 'user1@example.com',
                'password'  => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'name' => 'User Dua',
                'username' => 'user2',
                'email' => 'user2@example.com',
                'password'  => Hash::make('password'),
                'role' => 'user',
            ],
            [
                'name' => 'User Tiga',
                'username' => 'user3',
                'email' => 'user3@example.com',
                'password'  => Hash::make('password'),
                'role' => 'user',
            ],
        ];
        DB::table('users')->insert($data);
    }
}
