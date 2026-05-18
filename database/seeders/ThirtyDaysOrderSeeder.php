<?php

namespace Database\Seeders;

use App\Enums\OrderStatus;
use App\Models\Menu;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class ThirtyDaysOrderSeeder extends Seeder
{
    public function run(): void
    {
        $menus = Menu::query()->where('is_available', true)->orderBy('id')->take(5)->get();

        if ($menus->isEmpty()) {
            $this->command?->warn('Tidak ada menu tersedia. Seeder dibatalkan.');
            return;
        }

        $startDate = Carbon::today();

        for ($day = 0; $day < 30; $day++) {
            $eventDate = $startDate->copy()->addDays($day);
            $status = $day % 2 === 0 ? OrderStatus::Confirmed : OrderStatus::Processing;

            $orderCountForDay = 1 + ($day % 2);

            for ($seq = 1; $seq <= $orderCountForDay; $seq++) {
                $invoiceNumber = sprintf('INV-%s-%03d', $eventDate->format('Ymd'), 600 + ($day * 2) + $seq);

                $order = Order::query()->updateOrCreate(
                    ['invoice_number' => $invoiceNumber],
                    [
                        'customer_name' => 'Customer Demo ' . $eventDate->format('d') . '-' . $seq,
                        'customer_whatsapp' => '08' . str_pad((string) (811000000 + ($day * 17) + $seq), 10, '0', STR_PAD_LEFT),
                        'event_address' => 'Jl. Demo Catering No. ' . (10 + $day) . ', Surabaya',
                        'event_date' => $eventDate->toDateString(),
                        'event_time' => sprintf('%02d:00', 8 + (($day + $seq) % 9)),
                        'notes' => 'Auto seed 30 hari untuk uji rekap bahan.',
                        'status' => $status,
                        'total_amount' => 0,
                    ]
                );

                $order->items()->delete();

                $selectedMenus = $menus->shuffle()->take(min(2, $menus->count()));
                $totalAmount = 0;

                foreach ($selectedMenus as $index => $menu) {
                    $quantity = 15 + (($day + $seq + $index) % 21);
                    $price = (float) $menu->price;
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

        $this->command?->info('Seeder 30 hari selesai.');
    }
}
