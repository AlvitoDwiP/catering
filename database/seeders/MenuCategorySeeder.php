<?php

namespace Database\Seeders;

use App\Models\MenuCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Nasi Kotak',
            'Snack Box',
            'Minuman',
            'Paket Catering',
        ];

        foreach ($categories as $name) {
            MenuCategory::query()->updateOrCreate(
                ['slug' => Str::slug($name)],
                [
                    'name' => $name,
                    'description' => null,
                ]
            );
        }
    }
}
