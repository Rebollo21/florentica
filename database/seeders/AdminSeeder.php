<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // IMPORTANTE: Para encontrar la tabla
use Illuminate\Support\Facades\Hash; // IMPORTANTE: Para encriptar la clave
use App\Enums\UserRole; // IMPORTANTE: Para usar tu Enum de roles

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Oswaldo Admin',
            'email' => 'admin2@florentica.com', // Tu correo de acceso
            'password' => Hash::make('LGsusprim3.'), // Cambia esto por algo seguro
            'role' => UserRole::ADMIN, 
            'email_verified_at' => now(), // Saltamos la verificación de correo
        ]);
    }
}