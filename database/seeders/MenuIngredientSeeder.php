<?php

namespace Database\Seeders;

use App\Models\Ingredient;
use App\Models\Menu;
use App\Models\MenuIngredient;
use Illuminate\Database\Seeder;

class MenuIngredientSeeder extends Seeder
{
    public function run(): void
    {
        $map = [
            'Nasi Kotak Ayam' => [
                ['Beras', 100],
                ['Ayam', 1],
                ['Sambal', 20],
                ['Lalapan', 30],
                ['Kotak nasi', 1],
                ['Sendok plastik', 1],
                ['Tisu', 1],
            ],
            'Nasi Kotak Ikan' => [
                ['Beras', 100],
                ['Ikan', 1],
                ['Sambal', 20],
                ['Sayur', 40],
                ['Kotak nasi', 1],
                ['Sendok plastik', 1],
                ['Tisu', 1],
            ],
            'Snack Box A' => [
                ['Kotak snack', 1],
                ['Kue basah', 2],
                ['Risol', 1],
                ['Lemper', 1],
                ['Tisu', 1],
            ],
            'Snack Box Premium' => [
                ['Kotak snack', 1],
                ['Kue basah', 3],
                ['Risol', 2],
                ['Lemper', 1],
                ['Tisu', 1],
            ],
            'Es Teh' => [
                ['Teh', 5],
                ['Gula', 15],
                ['Es batu', 100],
                ['Cup plastik', 1],
            ],
            'Air Mineral' => [
                ['Air mineral', 1],
            ],
            'Paket Rapat Hemat' => [
                ['Beras', 100],
                ['Ayam', 1],
                ['Sambal', 20],
                ['Lalapan', 30],
                ['Kotak nasi', 1],
                ['Sendok plastik', 1],
                ['Teh', 5],
                ['Gula', 15],
                ['Es batu', 100],
                ['Cup plastik', 1],
                ['Tisu', 1],
            ],
        ];

        foreach ($map as $menuName => $ingredients) {
            $menu = Menu::query()->where('name', $menuName)->first();

            if (! $menu) {
                continue;
            }

            foreach ($ingredients as [$ingredientName, $quantity]) {
                $ingredient = Ingredient::query()->where('name', $ingredientName)->first();

                if (! $ingredient) {
                    continue;
                }

                MenuIngredient::query()->updateOrCreate(
                    [
                        'menu_id' => $menu->id,
                        'ingredient_id' => $ingredient->id,
                    ],
                    [
                        'quantity_per_portion' => $quantity,
                        'unit' => $ingredient->unit,
                    ]
                );
            }
        }
    }
}
