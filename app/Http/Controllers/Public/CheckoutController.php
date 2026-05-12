<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StoreCheckoutRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CheckoutController extends Controller
{
    public function create(): View
    {
        return view('public.checkout.create');
    }

    public function review(StoreCheckoutRequest $request): View
    {
        $validated = $request->validated();

        return view('public.checkout.review', compact('validated'));
    }

    public function store(StoreCheckoutRequest $request): RedirectResponse
    {
        return redirect()->route('public.checkout.create')->with('status', 'Checkout akan diimplementasikan di Sprint berikutnya.');
    }
}
