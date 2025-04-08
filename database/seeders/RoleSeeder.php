<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Roles;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // get all roles
        $roles = [
            ['name' => 'admin'],
            ['name' => 'user']
        ];

        // insert roles
        // foreach ($roles as $role) {
        //     Roles::create($role);
        // }

        DB::table('roles')->insert($roles);
    }
}
