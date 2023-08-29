<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $SuperAdmin = User::create([
            'username' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $SuperAdmin->assignRole('SUPER ADMIN');

        $AdminDirektorat = User::create([
            'username' => 'Admin Direktorat',
            'email' => 'admindirektorat@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $AdminDirektorat->assignRole('ADMIN DIREKTORAT');

        $AdminSatker = User::create([
            'username' => 'Admin Satker',
            'email' => 'adminsatker@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $AdminSatker->assignRole('ADMIN SATKER');
    }
}
