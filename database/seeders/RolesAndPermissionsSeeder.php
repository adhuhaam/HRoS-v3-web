<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Define permissions
        $permissions = [
            'view employees',
            'add employees',
            'edit employees',
            'delete employees',
            // Add more as needed...
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Define roles and the permissions they get
        $rolesWithPermissions = [
            'super admin' => Permission::all()->pluck('name')->toArray(),
            'hr manager' => ['view employees', 'add employees', 'edit employees', 'delete employees'],
            'hr staff' => ['view employees', 'add employees', 'edit employees'],
            'manager' => ['view employees'],
            'supervisor' => ['view employees'],
            'employee' => [],
            'management' => ['view employees'],
            'reception' => ['view employees'],
            'agents' => [],
            'clients' => [],
            'guest' => [],
        ];

        foreach ($rolesWithPermissions as $roleName => $perms) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($perms);

            $email = str_replace(' ', '', strtolower($roleName)) . '@hros.com';

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => ucfirst($roleName) . ' User',
                    'password' => Hash::make('password'),
                ]
            );

            if (!$user->hasRole($roleName)) {
                $user->assignRole($role);
            }
        }
    }
}
