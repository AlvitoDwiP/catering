<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        $menus = [
            [
                'name' => 'Nasi Kotak Ayam',
                'category' => 'Nasi Kotak',
                'description' => 'Nasi pulen, ayam bumbu rempah, sambal terasi, dan lalapan segar. Cocok untuk berbagai acara.',
                'price' => 25000,
                'unit' => 'porsi',
                'minimum_order' => 20,
                'is_available' => true,
                'is_recommended' => true,
            ],
            [
                'name' => 'Snack Box A',
                'category' => 'Snack Box',
                'description' => 'Pilihan snack manis dan gurih untuk berbagai acara, meeting, seminar, arisan, hingga pengajian.',
                'price' => 15000,
                'unit' => 'box',
                'minimum_order' => 30,
                'is_available' => true,
                'is_recommended' => true,
            ],
            [
                'name' => 'Nasi Kotak Ikan',
                'category' => 'Nasi Kotak',
                'description' => 'Nasi pulen, ikan bumbu kuning, sambal, dan sayuran. Pilihan sehat dan lezat untuk keluarga.',
                'price' => 27000,
                'unit' => 'porsi',
                'minimum_order' => 20,
                'is_available' => true,
                'is_recommended' => true,
            ],
            [
                'name' => 'Es Teh',
                'category' => 'Minuman',
                'description' => 'Minuman pendamping menyegarkan untuk paket catering. Disajikan dingin dan siap saji.',
                'price' => 5000,
                'unit' => 'cup',
                'minimum_order' => 20,
                'is_available' => true,
                'is_recommended' => true,
            ],
        ];

        foreach ($menus as $item) {
            $category = MenuCategory::query()->where('name', $item['category'])->firstOrFail();

            Menu::query()->updateOrCreate(
                ['slug' => Str::slug($item['name'])],
                [
                    'menu_category_id' => $category->id,
                    'name' => $item['name'],
                    'description' => $item['description'],
                    'price' => $item['price'],
                    'unit' => $item['unit'],
                    'minimum_order' => $item['minimum_order'],
                    'is_available' => $item['is_available'],
                    'is_recommended' => $item['is_recommended'],
                ]
            );
        }
    }
}
