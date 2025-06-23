<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
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
            'agent',
            'client',
            'guest'
        ];

        foreach ($roles as $roleName) {
            // Create role if it doesn't already exist
            $role = Role::firstOrCreate(['name' => $roleName]);

            // Generate email: removes spaces → e.g. hr manager → hrmanager@hros.com
            $email = str_replace(' ', '', strtolower($roleName)) . '@hros.com';

            // Create user if not exists
            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => ucfirst($roleName) . ' User',
                    'password' => Hash::make('password'), // Replace with a secure password in production
                ]
            );

            // Assign role if not already assigned
            if (!$user->hasRole($roleName)) {
                $user->assignRole($role);
            }

            // Optional: Output info to console
            $this->command->info("User {$user->email} with role '{$roleName}' seeded.");
            $this->call([
                RolesAndPermissionsSeeder::class,
            ]);
            $this->call([
                RolesSeeder::class,
            ]);
        }
    }
}
