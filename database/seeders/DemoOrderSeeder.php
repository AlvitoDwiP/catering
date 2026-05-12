<?php

namespace Database\Seeders;

use App\Enums\OrderStatus;
use App\Models\Menu;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class DemoOrderSeeder extends Seeder
{
    public function run(): void
    {
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();

        $orders = [
            [
                'sequence' => 1,
                'customer_name' => 'Siti Rahma',
                'customer_whatsapp' => '081234567890',
                'event_address' => 'Jl. Raya Darmo No. 10, Surabaya',
                'event_date' => $today->copy(),
                'event_time' => '10:00',
                'notes' => 'Mohon sambal dipisah.',
                'status' => OrderStatus::New,
                'items' => [
                    ['menu' => 'Nasi Kotak Ayam', 'quantity' => 20],
                    ['menu' => 'Es Teh', 'quantity' => 20],
                ],
            ],
            [
                'sequence' => 2,
                'customer_name' => 'Budi Santoso',
                'customer_whatsapp' => '081298765432',
                'event_address' => 'Jl. Manyar Kertoarjo No. 21, Surabaya',
                'event_date' => $tomorrow->copy(),
                'event_time' => '12:30',
                'notes' => 'Acara kantor divisi marketing.',
                'status' => OrderStatus::New,
                'items' => [
                    ['menu' => 'Snack Box A', 'quantity' => 30],
                    ['menu' => 'Air Mineral', 'quantity' => 30],
                ],
            ],
            [
                'sequence' => 3,
                'customer_name' => 'Rina Anggraini',
                'customer_whatsapp' => '082112223334',
                'event_address' => 'Jl. Ngagel Jaya Selatan No. 8, Surabaya',
                'event_date' => $today->copy(),
                'event_time' => '15:00',
                'notes' => 'Untuk rapat komunitas.',
                'status' => OrderStatus::Confirmed,
                'items' => [
                    ['menu' => 'Nasi Kotak Ikan', 'quantity' => 25],
                    ['menu' => 'Es Teh', 'quantity' => 25],
                ],
            ],
            [
                'sequence' => 4,
                'customer_name' => 'Andi Pratama',
                'customer_whatsapp' => '081345678901',
                'event_address' => 'Jl. Ahmad Yani No. 112, Surabaya',
                'event_date' => $tomorrow->copy(),
                'event_time' => '11:00',
                'notes' => 'Meeting mingguan tim.',
                'status' => OrderStatus::Confirmed,
                'items' => [
                    ['menu' => 'Paket Rapat Hemat', 'quantity' => 20],
                ],
            ],
            [
                'sequence' => 5,
                'customer_name' => 'Maya Lestari',
                'customer_whatsapp' => '082233344455',
                'event_address' => 'Jl. Diponegoro No. 45, Surabaya',
                'event_date' => $today->copy(),
                'event_time' => '09:30',
                'notes' => 'Acara keluarga kecil.',
                'status' => OrderStatus::Processing,
                'items' => [
                    ['menu' => 'Nasi Kotak Ayam', 'quantity' => 30],
                    ['menu' => 'Air Mineral', 'quantity' => 30],
                ],
            ],
            [
                'sequence' => 6,
                'customer_name' => 'Dimas Nugroho',
                'customer_whatsapp' => '081377788899',
                'event_address' => 'Jl. Raya Darmo No. 10, Surabaya',
                'event_date' => $today->copy()->addDays(3),
                'event_time' => '13:00',
                'notes' => 'Acara pelatihan internal.',
                'status' => OrderStatus::Completed,
                'items' => [
                    ['menu' => 'Snack Box Premium', 'quantity' => 40],
                    ['menu' => 'Es Teh', 'quantity' => 40],
                ],
            ],
            [
                'sequence' => 7,
                'customer_name' => 'Nur Aisyah',
                'customer_whatsapp' => '082144455566',
                'event_address' => 'Jl. Manyar Kertoarjo No. 21, Surabaya',
                'event_date' => $today->copy()->addDays(6),
                'event_time' => '16:00',
                'notes' => 'Acara ditunda oleh panitia.',
                'status' => OrderStatus::Cancelled,
                'items' => [
                    ['menu' => 'Nasi Kotak Ikan', 'quantity' => 20],
                    ['menu' => 'Air Mineral', 'quantity' => 20],
                ],
            ],
        ];

        foreach ($orders as $data) {
            $invoiceNumber = 'INV-' . $data['event_date']->format('Ymd') . '-' . str_pad((string) $data['sequence'], 3, '0', STR_PAD_LEFT);

            $order = Order::query()->updateOrCreate(
                ['invoice_number' => $invoiceNumber],
                [
                    'customer_name' => $data['customer_name'],
                    'customer_whatsapp' => $data['customer_whatsapp'],
                    'event_address' => $data['event_address'],
                    'event_date' => $data['event_date']->toDateString(),
                    'event_time' => $data['event_time'],
                    'notes' => $data['notes'],
                    'status' => $data['status'],
                    'total_amount' => 0,
                ]
            );

            $order->items()->delete();

            $totalAmount = 0;

            foreach ($data['items'] as $itemData) {
                $menu = Menu::query()->where('name', $itemData['menu'])->firstOrFail();
                $price = (float) $menu->price;
                $quantity = (int) $itemData['quantity'];
                $subtotal = $price * $quantity;
                $totalAmount += $subtotal;

                $order->items()->create([
                    'menu_id' => $menu->id,
                    'menu_name' => $menu->name,
                    'price' => $price,
                    'quantity' => $quantity,
                    'subtotal' => $subtotal,
                ]);
            }

            $order->update(['total_amount' => $totalAmount]);
        }
    }
}
