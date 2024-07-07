<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create permissions
        $permissions = [
            'use user management',
            'use info management',
            'use instruction management',
            'use department management',
            'use task management',
            'use employee management',
            'use attendance management',
            'use leave management',
            'use chatbot',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo($permissions);

        $hrRole = Role::create(['name' => 'hr']);
        $hrRole->givePermissionTo([
            'use info management',
            'use department management',
            'use task management',
            'use employee management',
            'use attendance management',
            'use leave management',
            'use chatbot',
        ]);

        $employeeRole = Role::create(['name' => 'employee']);
        $employeeRole->givePermissionTo('use chatbot');

        Role::create(['name' => 'user']);
    }
}
