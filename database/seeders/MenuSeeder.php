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
                'name' => 'Snack Box Premium',
                'category' => 'Snack Box',
                'description' => 'Paket snack premium berisi pilihan kue dan camilan untuk acara formal maupun keluarga.',
                'price' => 22000,
                'unit' => 'box',
                'minimum_order' => 30,
                'is_available' => true,
                'is_recommended' => false,
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
            [
                'name' => 'Air Mineral',
                'category' => 'Minuman',
                'description' => 'Air mineral kemasan untuk melengkapi kebutuhan konsumsi acara.',
                'price' => 4000,
                'unit' => 'botol',
                'minimum_order' => 20,
                'is_available' => true,
                'is_recommended' => false,
            ],
            [
                'name' => 'Paket Rapat Hemat',
                'category' => 'Paket Catering',
                'description' => 'Paket konsumsi praktis untuk rapat kantor berisi nasi kotak dan minuman.',
                'price' => 30000,
                'unit' => 'paket',
                'minimum_order' => 20,
                'is_available' => true,
                'is_recommended' => false,
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
