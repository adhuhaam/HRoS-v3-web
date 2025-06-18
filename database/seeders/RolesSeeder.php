<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            'super admin',
            'management',
            'hr manager',
            'manager',
            'hr staff',
            'supervisor',
            'employee',
            'reception',
            'agents',
            'clients',
            'guest'
        ];

        foreach ($roles as $roleName) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $this->command->info("Role '{$roleName}' created.");
        }
    }
}
