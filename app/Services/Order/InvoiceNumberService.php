<?php

namespace App\Services\Order;

use App\Models\Order;
use Carbon\Carbon;

class InvoiceNumberService
{
    public function generate(): string
    {
        $today = Carbon::today();
        $prefix = 'INV-' . $today->format('Ymd') . '-';

        $lastInvoice = Order::query()
            ->whereDate('created_at', $today)
            ->where('invoice_number', 'like', $prefix . '%')
            ->lockForUpdate()
            ->orderByDesc('invoice_number')
            ->value('invoice_number');

        $lastSequence = 0;

        if ($lastInvoice) {
            $lastSequence = (int) substr($lastInvoice, -3);
        }

        $nextSequence = $lastSequence + 1;

        return $prefix . str_pad((string) $nextSequence, 3, '0', STR_PAD_LEFT);
    }
}
