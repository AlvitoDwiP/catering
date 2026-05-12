<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KitchenUserSeeder extends Seeder
{
    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'dapur@nadskitchen.test'],
            [
                'name' => "Dapur Nad's Kitchen",
                'password' => Hash::make('password'),
                'role' => UserRole::Kitchen,
            ]
        );
    }
}
