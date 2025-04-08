<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get all users
        $data = [
            [
                'username' => 'admin',
                'name' => 'Administator',
                'email' => 'admin@gmail.com',
                'role_id' => 1,
                'password' => Hash::make('admin123')
            ],
            [
                'username' => 'user',
                'name' => 'User',
                'email' => 'user@gmail.com',
                'role_id' => 2,
                'password' => Hash::make('user123')
            ]
        ];

        // insert users
        DB::table('users')->insert($data);
    }
}
