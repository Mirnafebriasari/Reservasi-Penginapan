<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; 
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        $user = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'email_verified_at' => now(),
                'password' => Hash::make('admin123'), 
            ]
        );

        $user->assignRole('admin');
    }
}
