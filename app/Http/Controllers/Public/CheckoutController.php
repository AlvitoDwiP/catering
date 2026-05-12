<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StoreCheckoutRequest;
use App\Services\Cart\CartService;
use App\Services\Order\CheckoutService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use RuntimeException;

class CheckoutController extends Controller
{
    public function create(CartService $cart): View|RedirectResponse
    {
        if ($cart->isEmpty()) {
            return redirect()->route('public.cart.index')->with('error', 'Keranjang masih kosong.');
        }

        return view('public.checkout.create', [
            'cartItems' => $cart->all(),
            'cartTotal' => $cart->totalAmount(),
            'checkoutData' => session('checkout.data', []),
        ]);
    }

    public function review(StoreCheckoutRequest $request, CartService $cart): View|RedirectResponse
    {
        if ($cart->isEmpty()) {
            return redirect()->route('public.cart.index')->with('error', 'Keranjang masih kosong.');
        }

        $customerData = $request->validated();
        session(['checkout.data' => $customerData]);

        return view('public.checkout.review', [
            'customerData' => $customerData,
            'cartItems' => $cart->all(),
            'cartTotal' => $cart->totalAmount(),
        ]);
    }

    public function store(StoreCheckoutRequest $request, CheckoutService $checkoutService): RedirectResponse
    {
        $customerData = $request->validated();

        if (blank($customerData)) {
            $customerData = session('checkout.data', []);
        }

        try {
            $order = $checkoutService->createOrder($customerData);
        } catch (RuntimeException $exception) {
            return redirect()->route('public.cart.index')->with('error', $exception->getMessage());
        }

        session()->forget('checkout.data');

        return redirect()
            ->route('public.invoices.show', $order)
            ->with('success', 'Pesanan berhasil dibuat.');
    }
}
