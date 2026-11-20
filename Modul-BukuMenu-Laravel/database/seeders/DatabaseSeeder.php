<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Membuat akun Admin
        User::updateOrCreate(
            ['username' => 'admin'],
            [
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
            ]
        );

        // Membuat akun Staff
        User::updateOrCreate(
            ['username' => 'staff'],
            [
                'password' => Hash::make('staff12345'),
                'role' => 'staff',
            ]
        );
    }
}
