<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'user@email.com'],
            [
                'name'     => 'User Biasa',
                'password' => Hash::make('123'),
                'role'     => 'user',
            ]
        );
        // Admin
        $this->call([AdminSeeder::class]);

        // User biasa


        $this->call([
            SkemaSeeder::class,
            PesertaSeeder::class,
        ]);
    }
}
