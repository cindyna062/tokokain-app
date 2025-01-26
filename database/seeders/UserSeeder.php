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
            // [
            //     'name'      => 'Admin',
            //     'username'  => 'Admin',
            //     'email'     => 'admin@gmail.com',
            //     'role'      => 'Admin',
            //     'password'  => Hash::make('password')
            // ],
            [
                'name'      => 'user',
                'username'  => 'user',
                'email'     => 'user@gmail.com',
                'role'      => 'user',
                'password'  => Hash::make('password')
            ],
        ];
        DB::table('users')->insert($data);
    }
}
