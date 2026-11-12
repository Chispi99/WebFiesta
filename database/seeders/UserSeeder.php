<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Administrador mayor de edad
        User::updateOrCreate(
            ['email' => 'admin@resort.com'],
            [
                'name' => 'Director General (Admin)',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
                'age' => 42,
            ]
        );

        // 2. Usuario normal mayor de edad
        User::updateOrCreate(
            ['email' => 'adulto@resort.com'],
            [
                'name' => 'Carlos López (Adulto)',
                'password' => Hash::make('adulto123'),
                'is_admin' => false,
                'age' => 26,
            ]
        );

        // 3. Usuario normal menor de edad
        User::updateOrCreate(
            ['email' => 'menor@resort.com'],
            [
                'name' => 'Mateo Fernández (Menor)',
                'password' => Hash::make('menor123'),
                'is_admin' => false,
                'age' => 16,
            ]
        );
    }
}

