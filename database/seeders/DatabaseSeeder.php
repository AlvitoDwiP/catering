<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class,
            KitchenUserSeeder::class,
            MenuCategorySeeder::class,
            MenuSeeder::class,
            IngredientSeeder::class,
            MenuIngredientSeeder::class,
            DemoOrderSeeder::class,
        ]);
    }
}
