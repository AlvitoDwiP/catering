<?php

namespace App\Http\Controllers\Admin;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function orders(Request $request): View
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());
        $status = $request->input('status');
        $menuId = $request->input('menu_id');

        $baseQuery = Order::query()
            ->whereBetween('event_date', [$startDate, $endDate])
            ->when($status, fn ($query) => $query->where('status', $status))
            ->when($menuId, function ($query) use ($menuId) {
                $query->whereHas('items', fn ($q) => $q->where('menu_id', $menuId));
            });

        $totalOrders = (clone $baseQuery)->count();
        $totalRevenue = (float) (clone $baseQuery)->sum('total_amount');

        $ordersByStatus = (clone $baseQuery)
            ->select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->orderBy('status')
            ->get();

        $topMenus = DB::table('order_items')
            ->join('orders', 'orders.id', '=', 'order_items.order_id')
            ->whereBetween('orders.event_date', [$startDate, $endDate])
            ->when($status, fn ($query) => $query->where('orders.status', $status))
            ->when($menuId, fn ($query) => $query->where('order_items.menu_id', $menuId))
            ->select('order_items.menu_name', DB::raw('SUM(order_items.quantity) as total_quantity'), DB::raw('SUM(order_items.subtotal) as total_subtotal'))
            ->groupBy('order_items.menu_name')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();

        $dailyOrders = (clone $baseQuery)
            ->select('event_date', DB::raw('COUNT(*) as total_orders'), DB::raw('SUM(total_amount) as total_revenue'))
            ->groupBy('event_date')
            ->orderBy('event_date')
            ->get();

        $latestOrders = (clone $baseQuery)
            ->withCount('items')
            ->latest('event_date')
            ->latest('created_at')
            ->limit(10)
            ->get();

        return view('admin.reports.orders', [
            'startDate' => $startDate,
            'endDate' => $endDate,
            'selectedStatus' => $status,
            'selectedMenuId' => $menuId,
            'menus' => Menu::query()->orderBy('name')->get(),
            'statuses' => OrderStatus::cases(),
            'totalOrders' => $totalOrders,
            'totalRevenue' => $totalRevenue,
            'ordersByStatus' => $ordersByStatus,
            'topMenus' => $topMenus,
            'dailyOrders' => $dailyOrders,
            'latestOrders' => $latestOrders,
        ]);
    }
}
