<?php

namespace App\Http\Controllers\Kitchen;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Production\BomCalculationService;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ProductionOrderController extends Controller
{
    public function index(Request $request): View
    {
        $statuses = [OrderStatus::Confirmed->value, OrderStatus::Processing->value];
        $eventDate = $request->input('event_date');

        $orders = Order::query()
            ->with('items')
            ->whereIn('status', $statuses)
            ->when($eventDate, fn ($query) => $query->whereDate('event_date', $eventDate), fn ($query) => $query->whereDate('event_date', '>=', Carbon::today()))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->input('status')))
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->input('search');
                $query->where(function ($q) use ($search) {
                    $q->where('invoice_number', 'like', '%' . $search . '%')
                        ->orWhere('customer_name', 'like', '%' . $search . '%');
                });
            })
            ->orderBy('event_date')
            ->orderBy('event_time')
            ->paginate(15)
            ->withQueryString();

        return view('kitchen.production-orders.index', [
            'orders' => $orders,
            'statuses' => [OrderStatus::Confirmed, OrderStatus::Processing],
        ]);
    }

    public function show(Order $order, BomCalculationService $bomCalculationService): View
    {
        if (! in_array($order->status->value, [OrderStatus::Confirmed->value, OrderStatus::Processing->value], true)) {
            abort(404);
        }

        $order->load(['items.menu.ingredients']);

        return view('kitchen.production-orders.show', [
            'order' => $order,
            'ingredientNeeds' => $bomCalculationService->calculateForOrder($order),
            'hasMissingBom' => $bomCalculationService->hasMissingBom($order),
            'missingBomMenus' => $bomCalculationService->missingBomMenus($order),
        ]);
    }
}
