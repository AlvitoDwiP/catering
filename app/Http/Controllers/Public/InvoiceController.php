<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Contracts\View\View;

class InvoiceController extends Controller
{
    public function show(Order $order): View
    {
        $order->load('items');

        return view('public.invoices.show', compact('order'));
    }
}
