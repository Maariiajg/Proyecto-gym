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
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@gym.com',
            'password' => Hash::make('password'),
        ]);
        $admin->assignRole('admin');

        $trainer = User::create([
            'name' => 'Trainer User',
            'email' => 'trainer@gym.com',
            'password' => Hash::make('password'),
        ]);
        $trainer->assignRole('trainer');

        $client = User::create([
            'name' => 'Client User',
            'email' => 'client@gym.com',
            'password' => Hash::make('password'),
        ]);
        $client->assignRole('client');
    }
}
