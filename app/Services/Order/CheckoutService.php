<?php

namespace App\Services\Order;

use App\Enums\OrderStatus;
use App\Models\Menu;
use App\Models\Order;
use App\Services\Cart\CartService;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class CheckoutService
{
    public function __construct(
        private readonly CartService $cart,
        private readonly InvoiceNumberService $invoiceNumberService,
    ) {
    }

    public function createOrder(array $customerData): Order
    {
        if ($this->cart->isEmpty()) {
            throw new RuntimeException('Keranjang masih kosong.');
        }

        return DB::transaction(function () use ($customerData): Order {
            $validatedItems = $this->validatedItemsFromCart();
            $totalAmount = array_sum(array_column($validatedItems, 'subtotal'));

            $order = Order::query()->create([
                'invoice_number' => $this->invoiceNumberService->generate(),
                'customer_name' => $customerData['customer_name'],
                'customer_whatsapp' => $customerData['customer_whatsapp'],
                'event_address' => $customerData['event_address'],
                'event_date' => $customerData['event_date'],
                'event_time' => $customerData['event_time'],
                'notes' => $customerData['notes'] ?? null,
                'total_amount' => $totalAmount,
                'status' => OrderStatus::New,
            ]);

            foreach ($validatedItems as $item) {
                $order->items()->create([
                    'menu_id' => $item['menu']->id,
                    'menu_name' => $item['menu']->name,
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            $this->cart->clear();

            return $order->load('items');
        });
    }

    /**
     * @return array<int, array{menu: Menu, quantity: int, price: float, subtotal: float}>
     */
    private function validatedItemsFromCart(): array
    {
        $items = [];

        foreach ($this->cart->all() as $item) {
            $menu = Menu::query()->find($item['menu_id'] ?? null);

            if (! $menu || ! $menu->is_available) {
                throw new RuntimeException('Ada menu di keranjang yang sudah tidak tersedia. Silakan perbarui keranjang.');
            }

            $quantity = (int) ($item['quantity'] ?? 0);

            if ($quantity < $menu->minimum_order) {
                throw new RuntimeException("Jumlah {$menu->name} kurang dari minimum order {$menu->minimum_order} {$menu->unit}.");
            }

            $price = (float) $menu->price;

            $items[] = [
                'menu' => $menu,
                'quantity' => $quantity,
                'price' => $price,
                'subtotal' => $price * $quantity,
            ];
        }

        if (empty($items)) {
            throw new RuntimeException('Keranjang masih kosong.');
        }

        return $items;
    }
}
