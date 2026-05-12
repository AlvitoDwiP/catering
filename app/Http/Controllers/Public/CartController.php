<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StoreCartItemRequest;
use App\Http\Requests\Public\UpdateCartItemRequest;
use App\Models\Menu;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    public function index(): View
    {
        return view('public.cart.index');
    }

    public function store(StoreCartItemRequest $request): RedirectResponse
    {
        return redirect()->route('public.cart.index')->with('status', 'Item ditambahkan ke keranjang.');
    }

    public function update(UpdateCartItemRequest $request, Menu $menu): RedirectResponse
    {
        return redirect()->route('public.cart.index')->with('status', 'Keranjang diperbarui.');
    }

    public function destroy(Menu $menu): RedirectResponse
    {
        return redirect()->route('public.cart.index')->with('status', 'Item dihapus dari keranjang.');
    }
}
