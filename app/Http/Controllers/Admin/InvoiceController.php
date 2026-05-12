<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Support\WhatsAppMessageService;
use Illuminate\Contracts\View\View;

class InvoiceController extends Controller
{
    public function __construct(private readonly WhatsAppMessageService $whatsAppMessageService)
    {
    }

    public function show(Order $order): View
    {
        $order->load('items');

        $message = $this->whatsAppMessageService->invoiceMessage($order);
        $whatsAppUrl = $this->whatsAppMessageService->customerPhoneUrl($order->customer_whatsapp, $message);

        return view('admin.invoices.show', compact('order', 'whatsAppUrl'));
    }
}
