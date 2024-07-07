<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        $adminRole = Role::where('name', 'admin')->first();
        User::create([
            'name' => 'Admin Mtim',
            'email' => 'mtim0343@gmail.com',
            'password' => Hash::make('mtimmtim26'),
        ])->assignRole($adminRole);

        $adminRole = Role::where('name', 'admin')->first();
        User::create([
            'name' => 'Admin Deon',
            'email' => 'admin@deon.com',
            'password' => Hash::make('password'),
        ])->assignRole($adminRole);

        // HR User
        $hrRole = Role::where('name', 'hr')->first();
        User::create([
            'name' => 'HR Mtim',
            'email' => 'tm052602@gmail.com',
            'password' => Hash::make('mtimmtim26'),
        ])->assignRole($hrRole);

        $hrRole = Role::where('name', 'hr')->first();
        User::create([
            'name' => 'HR Deon',
            'email' => 'hr@deon.com',
            'password' => Hash::make('password'),
        ])->assignRole($hrRole);

        // Employee User(s)
        $users = [
            [
                'name' => 'Hafidz Saputra',
                'email' => 'hafidz.saputra@krl.co.id',
            ],
            [
                'name' => 'Fathan Mubien',
                'email' => 'fathan.mubien@krl.co.id',
            ],
            [
                'name' => 'Abung Fayshal',
                'email' => 'abung.fayshal@krl.co.id',
            ],
            [
                'name' => 'Mtim',
                'email' => 'mtim@krl.co.id',
            ],
            [
                'name' => 'Muhammad Faishal Akbar',
                'email' => 'muhammad.akbar@krl.co.id',
            ],
            [
                'name' => 'Fajar Ramadhan Firmansyah',
                'email' => 'fajar.firmansyah@krl.co.id',
            ],
        ];

        foreach ($users as $user) {
            $employeeRole = Role::where('name', 'employee')->first();
            User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ])->assignRole($employeeRole);
        }

        $userRole = Role::where('name', 'user')->first();
        User::create([
            'name' => 'test user',
            'email' => 'test@user.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ])->assignRole($userRole);
    }
}
