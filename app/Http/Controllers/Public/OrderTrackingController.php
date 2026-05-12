<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\TrackOrderRequest;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class OrderTrackingController extends Controller
{
    public function create(): View
    {
        return view('public.orders.track');
    }

    public function store(TrackOrderRequest $request): RedirectResponse
    {
        $order = Order::query()
            ->where('invoice_number', $request->string('invoice_number')->toString())
            ->first();

        if (! $order) {
            return back()->withInput()->with('error', 'Nomor invoice tidak ditemukan.');
        }

        return redirect()->route('public.invoices.show', $order);
    }
}
