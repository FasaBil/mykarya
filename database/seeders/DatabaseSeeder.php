<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat akun Admin
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@mykarya.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Membuat akun User/Mahasiswa 
        User::create([
            'name' => 'Mahasiswa Peserta',
            'email' => 'mahasiswa@mykarya.com',
            'password' => Hash::make('password123'),
            'role' => 'user',
        ]);
    }
}