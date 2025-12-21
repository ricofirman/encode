<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ============ CREATE USERS FIRST ============
        $users = [
            [
                'name' => 'Admin Encode',
                'email' => 'admin@encode.test',
                'password' => Hash::make('admin123'), // Password: admin123
                'role' => 'admin',
            ],
            [
                'name' => 'John Doe',
                'email' => 'john@encode.test',
                'password' => Hash::make('user123'), // Password: user123
                'role' => 'user',
            ],
            [
                'name' => 'wong jowo',
                'email' => 'jawa@encode.test',
                'password' => Hash::make('user123'),
                'role' => 'user',
            ],
        ];

        // Create users
        foreach ($users as $user) {
            User::create($user);
        }

        // ============ CREATE PRODUCTS SECOND ============
        $this->call([
            ProductSeeder::class,
        ]);

    }
}