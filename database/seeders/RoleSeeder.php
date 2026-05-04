<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $trainerRole = Role::firstOrCreate(['name' => 'trainer']);
        $clientRole = Role::firstOrCreate(['name' => 'client']);

        // Usuario Admin Dummy
        $admin = User::firstOrCreate(
            ['email' => 'admin@gym.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole($adminRole);

        // Usuario Trainer Dummy
        $trainer = User::firstOrCreate(
            ['email' => 'trainer@gym.com'],
            [
                'name' => 'Trainer User',
                'password' => Hash::make('password'),
            ]
        );
        $trainer->assignRole($trainerRole);

        // Usuario Client Dummy
        $client = User::firstOrCreate(
            ['email' => 'client@gym.com'],
            [
                'name' => 'Client User',
                'password' => Hash::make('password'),
            ]
        );
        $client->assignRole($clientRole);
    }
}
