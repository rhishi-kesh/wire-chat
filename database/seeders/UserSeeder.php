<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Test User',
                'email' => 'test@test.com',
                'avatar' => 'test.png',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'Rhishi Kesh',
                'email' => 'reshikash300@gmail.com',
                'avatar' => 'RKB.jpg',
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@user.com',
                'avatar' => null,
                'password' => Hash::make('12345678'),
                'email_verified_at' => now(),
            ]
        ]);
    }
}
