<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::firstOrCreate(
            ['email' => 'admin@gym.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );
        $admin->assignRole('admin');

        $client = User::firstOrCreate(
            ['email' => 'client@gym.com'],
            [
                'name' => 'Client User',
                'password' => Hash::make('password'),
            ]
        );
        $client->assignRole('client');

        $users = [
            ['name' => 'Ana Martínez', 'email' => 'ana@gym.com'],
            ['name' => 'Carlos Ruiz', 'email' => 'carlos@gym.com'],
            ['name' => 'Elena Gómez', 'email' => 'elena@gym.com'],
            ['name' => 'David Torres', 'email' => 'david@gym.com'],
            ['name' => 'Laura Vega', 'email' => 'laura@gym.com'],
            ['name' => 'Miguel Sanz', 'email' => 'miguel@gym.com'],
            ['name' => 'Sofía Gil', 'email' => 'sofia@gym.com'],
        ];

        foreach ($users as $u) {
            $user = User::firstOrCreate(
                ['email' => $u['email']],
                [
                    'name' => $u['name'],
                    'password' => Hash::make('password'),
                ]
            );
            $user->assignRole('client');
        }
    }
}
