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

        $sequence = Order::query()
            ->whereDate('created_at', $today)
            ->count() + 1;

        return $prefix . str_pad((string) $sequence, 3, '0', STR_PAD_LEFT);
    }
}
