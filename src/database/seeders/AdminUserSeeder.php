<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run()
    {
       /* User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'mohammed',
            'email' => 'mohammed@example.com',
            'password' => Hash::make('password'),
            'role' => 'user',
        ]);*/
        User::create([
            'name' => 'Teste',
            'email' => 'Teste@gmail.com',
            'password' => Hash::make('TESTE@TESTE@123456789'),
            'role' => 'super admin',
        ]);
    }
}
