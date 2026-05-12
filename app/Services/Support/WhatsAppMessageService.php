<?php

namespace App\Services\Support;

use App\Models\Order;

class WhatsAppMessageService
{
    public function invoiceMessage(Order $order): string
    {
        return "Halo {$order->customer_name}, berikut detail pesanan Nad's Kitchen:\n"
            . "Invoice: {$order->invoice_number}\n"
            . 'Total: Rp' . number_format((float) $order->total_amount, 0, ',', '.') . "\n"
            . 'Status: ' . $order->status->label() . "\n\n"
            . 'Silakan konfirmasi pembayaran/pesanan melalui chat ini. Terima kasih.';
    }

    public function customerPhoneUrl(string $phone, string $message): string
    {
        $phone = preg_replace('/\D+/', '', $phone) ?? '';

        if (str_starts_with($phone, '0')) {
            $phone = '62' . substr($phone, 1);
        }

        if (! str_starts_with($phone, '62')) {
            $phone = '62' . ltrim($phone, '0');
        }

        return 'https://wa.me/' . $phone . '?text=' . urlencode($message);
    }
}
