<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $today = Carbon::today();
        $startOfMonth = Carbon::now()->startOfMonth();

        $latestOrders = Order::query()
            ->withCount('items')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', [
            'totalOrdersToday' => Order::query()->whereDate('created_at', $today)->count(),
            'newOrdersCount' => Order::query()->where('status', OrderStatus::New->value)->count(),
            'confirmedOrdersCount' => Order::query()->where('status', OrderStatus::Confirmed->value)->count(),
            'processingOrdersCount' => Order::query()->where('status', OrderStatus::Processing->value)->count(),
            'completedOrdersCount' => Order::query()->where('status', OrderStatus::Completed->value)->count(),
            'cancelledOrdersCount' => Order::query()->where('status', OrderStatus::Cancelled->value)->count(),
            'totalRevenueThisMonth' => (float) Order::query()
                ->where('status', OrderStatus::Completed->value)
                ->whereDate('created_at', '>=', $startOfMonth)
                ->sum('total_amount'),
            'latestOrders' => $latestOrders,
            'recommendedMenusCount' => Menu::query()->where('is_recommended', true)->count(),
            'availableMenusCount' => Menu::query()->where('is_available', true)->count(),
        ]);
    }
}
