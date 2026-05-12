<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use Illuminate\Database\Seeder;

class IngredientSeeder extends Seeder
{
    public function run(): void
    {
        $ingredients = [
            ['name' => 'Beras', 'unit' => 'gram', 'category' => 'Bahan makanan'],
            ['name' => 'Ayam', 'unit' => 'potong', 'category' => 'Bahan makanan'],
            ['name' => 'Ikan', 'unit' => 'potong', 'category' => 'Bahan makanan'],
            ['name' => 'Sambal', 'unit' => 'gram', 'category' => 'Bumbu'],
            ['name' => 'Lalapan', 'unit' => 'gram', 'category' => 'Bahan makanan'],
            ['name' => 'Kotak nasi', 'unit' => 'pcs', 'category' => 'Packaging'],
            ['name' => 'Kotak snack', 'unit' => 'pcs', 'category' => 'Packaging'],
            ['name' => 'Sendok plastik', 'unit' => 'pcs', 'category' => 'Perlengkapan tambahan'],
            ['name' => 'Teh', 'unit' => 'gram', 'category' => 'Minuman'],
            ['name' => 'Cup plastik', 'unit' => 'pcs', 'category' => 'Packaging'],
            ['name' => 'Gula', 'unit' => 'gram', 'category' => 'Minuman'],
            ['name' => 'Es batu', 'unit' => 'gram', 'category' => 'Minuman'],
        ];

        foreach ($ingredients as $item) {
            Ingredient::query()->updateOrCreate(
                ['name' => $item['name'], 'unit' => $item['unit']],
                ['category' => $item['category'], 'notes' => null]
            );
        }
    }
}
