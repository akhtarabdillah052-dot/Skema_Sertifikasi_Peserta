<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::updateOrCreate(
            ['email' => 'admin@sekolah.sch.id'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('password123'),
                'role'     => 'admin',
            ]
        );

        // User biasa
        User::updateOrCreate(
            ['email' => 'user@email.com'],
            [
                'name'     => 'User Biasa',
                'password' => Hash::make('123'),
                'role'     => 'user',
            ]
        );

        $this->call([
            SkemaSeeder::class,
            PesertaSeeder::class,
        ]);
    }
}