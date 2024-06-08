<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        $adminRole = Role::where('name', 'admin')->first(); 
        User::create([
            'name' => 'Admin Mtim',
            'email' => 'admin@example.com',
            'password' => Hash::make('mtimmtim26'), 
        ])->assignRole($adminRole); 

        // HR User
        $hrRole = Role::where('name', 'hr')->first(); 
        User::create([
            'name' => 'HR Mtim',
            'email' => 'hr@example.com',
            'password' => Hash::make('mtimmtim26'), 
        ])->assignRole($hrRole);

        // Employee User(s)
        $employeeRole = Role::where('name', 'employee')->first();
        for ($i = 1; $i <= 5; $i++) { 
            User::create([
                'name' => "Mtim $i",
                'email' => "employee$i@example.com",
                'password' => Hash::make('mtimmtim26'), 
            ])->assignRole($employeeRole);
        }
    }
}
