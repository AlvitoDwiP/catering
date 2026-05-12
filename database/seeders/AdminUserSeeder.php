<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@nadskitchen.test'],
            [
                'name' => "Admin Nad's Kitchen",
                'password' => Hash::make('password'),
                'role' => UserRole::Admin,
            ]
        );
    }
}
