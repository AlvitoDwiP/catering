<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\TrackOrderRequest;
use App\Models\Order;
use Illuminate\Contracts\View\View;

class OrderTrackingController extends Controller
{
    public function create(): View
    {
        return view('public.orders.track');
    }

    public function store(TrackOrderRequest $request): View
    {
        $order = Order::query()->where('invoice_number', $request->string('invoice_number'))->first();

        return view('public.orders.track', compact('order'));
    }
}
