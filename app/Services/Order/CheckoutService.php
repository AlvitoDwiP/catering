<?php

namespace App\Services\Order;

use App\Enums\OrderStatus;
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
            $order = Order::query()->create([
                'invoice_number' => $this->invoiceNumberService->generate(),
                'customer_name' => $customerData['customer_name'],
                'customer_whatsapp' => $customerData['customer_whatsapp'],
                'event_address' => $customerData['event_address'],
                'event_date' => $customerData['event_date'],
                'event_time' => $customerData['event_time'],
                'notes' => $customerData['notes'] ?? null,
                'total_amount' => $this->cart->totalAmount(),
                'status' => OrderStatus::New,
            ]);

            foreach ($this->cart->all() as $item) {
                $order->items()->create([
                    'menu_id' => $item['menu_id'],
                    'menu_name' => $item['name'],
                    'price' => $item['price'],
                    'quantity' => $item['quantity'],
                    'subtotal' => $item['subtotal'],
                ]);
            }

            $this->cart->clear();

            return $order->load('items');
        });
    }
}
