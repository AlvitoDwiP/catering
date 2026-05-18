<?php

namespace App\Http\Controllers\Kitchen;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Production\BomCalculationService;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IngredientRecapController extends Controller
{
    public function index(Request $request, BomCalculationService $bomCalculationService): View
    {
        $statuses = [OrderStatus::Confirmed->value, OrderStatus::Processing->value];
        $nearestEventDate = Order::query()
            ->whereIn('status', $statuses)
            ->whereDate('event_date', '>=', Carbon::today()->toDateString())
            ->orderBy('event_date')
            ->value('event_date');

        $date = $request->input('date', $nearestEventDate ?: Carbon::today()->toDateString());

        $orders = Order::query()
            ->with(['items.menu.ingredients'])
            ->whereIn('status', $statuses)
            ->whereDate('event_date', $date)
            ->orderBy('event_time')
            ->get();

        $ingredientRecap = $bomCalculationService->calculateForOrders($orders);

        $missingBomOrders = $orders
            ->filter(fn (Order $order) => $bomCalculationService->hasMissingBom($order))
            ->map(fn (Order $order) => [
                'order' => $order,
                'menus' => $bomCalculationService->missingBomMenus($order),
            ])
            ->values();

        return view('kitchen.ingredient-recaps.index', [
            'selectedDate' => $date,
            'orders' => $orders,
            'ingredientRecap' => $ingredientRecap,
            'missingBomOrders' => $missingBomOrders,
        ]);
    }
}
