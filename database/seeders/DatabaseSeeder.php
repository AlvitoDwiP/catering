<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            MenuCategorySeeder::class,
            MenuSeeder::class,
            IngredientSeeder::class,
            MenuIngredientSeeder::class,
            AdminUserSeeder::class,
            KitchenUserSeeder::class,
        ]);
    }
}
