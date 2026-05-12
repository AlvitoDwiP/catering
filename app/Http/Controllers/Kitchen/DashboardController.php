<?php

namespace App\Http\Controllers\Kitchen;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\Production\BomCalculationService;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(BomCalculationService $bomCalculationService): View
    {
        $today = Carbon::today();
        $tomorrow = Carbon::tomorrow();
        $statuses = [OrderStatus::Confirmed->value, OrderStatus::Processing->value];

        $todayProductionOrders = Order::query()
            ->with('items')
            ->whereIn('status', $statuses)
            ->whereDate('event_date', $today)
            ->orderBy('event_time')
            ->get();

        $tomorrowProductionOrders = Order::query()
            ->with('items')
            ->whereIn('status', $statuses)
            ->whereDate('event_date', $tomorrow)
            ->orderBy('event_time')
            ->get();

        $todayIngredientRecap = $bomCalculationService->calculateForOrders($todayProductionOrders);

        $upcomingOrders = Order::query()
            ->with('items')
            ->whereIn('status', $statuses)
            ->whereDate('event_date', '>=', $today)
            ->orderBy('event_date')
            ->orderBy('event_time')
            ->limit(5)
            ->get();

        return view('kitchen.dashboard', [
            'todayProductionOrders' => $todayProductionOrders,
            'tomorrowProductionOrders' => $tomorrowProductionOrders,
            'confirmedOrdersCount' => Order::query()->where('status', OrderStatus::Confirmed->value)->count(),
            'processingOrdersCount' => Order::query()->where('status', OrderStatus::Processing->value)->count(),
            'todayIngredientRecap' => $todayIngredientRecap,
            'upcomingOrders' => $upcomingOrders,
        ]);
    }
}
