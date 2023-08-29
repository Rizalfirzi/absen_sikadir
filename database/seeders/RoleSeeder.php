<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create([
            'name' => 'SUPER ADMIN',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'ADMIN DIREKTORAT',
            'guard_name' => 'web',
        ]);

        Role::create([
            'name' => 'ADMIN SATKER',
            'guard_name' => 'web',
        ]);
    }
}
