<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateOrderStatusRequest;
use App\Models\Order;
use App\Services\Production\BomCalculationService;
use App\Services\Support\WhatsAppMessageService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrderController extends Controller
{
    public function __construct(
        private readonly WhatsAppMessageService $whatsAppMessageService,
        private readonly BomCalculationService $bomCalculationService,
    ) {
    }

    public function index(): View
    {
        $orders = Order::query()
            ->withCount('items')
            ->when(request('search'), function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('invoice_number', 'like', "%{$search}%")
                        ->orWhere('customer_name', 'like', "%{$search}%")
                        ->orWhere('customer_whatsapp', 'like', "%{$search}%");
                });
            })
            ->byStatus(request('status'))
            ->byEventDate(request('event_date'))
            ->latestOrders()
            ->paginate(15)
            ->withQueryString();

        return view('admin.orders.index', [
            'orders' => $orders,
            'statuses' => OrderStatus::cases(),
        ]);
    }

    public function show(Order $order): View
    {
        $order->load(['items.menu.ingredients']);

        $ingredientNeeds = $this->bomCalculationService->calculateForOrder($order);
        $missingBomMenus = $this->bomCalculationService->missingBomMenus($order);
        $hasMissingBom = $this->bomCalculationService->hasMissingBom($order);

        $message = $this->whatsAppMessageService->invoiceMessage($order);
        $whatsAppUrl = $this->whatsAppMessageService->customerPhoneUrl($order->customer_whatsapp, $message);

        return view('admin.orders.show', [
            'order' => $order,
            'statuses' => OrderStatus::cases(),
            'whatsAppUrl' => $whatsAppUrl,
            'ingredientNeeds' => $ingredientNeeds,
            'hasMissingBom' => $hasMissingBom,
            'missingBomMenus' => $missingBomMenus,
        ]);
    }

    public function updateStatus(UpdateOrderStatusRequest $request, Order $order): RedirectResponse
    {
        $order->update([
            'status' => $request->string('status')->toString(),
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
