<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Http\Requests\Public\StoreCartItemRequest;
use App\Http\Requests\Public\UpdateCartItemRequest;
use App\Models\Menu;
use App\Services\Cart\CartService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class CartController extends Controller
{
    public function index(CartService $cart): View
    {
        return view('public.cart.index', [
            'cartItems' => $cart->all(),
            'cartTotal' => $cart->totalAmount(),
            'cartTotalQuantity' => $cart->totalQuantity(),
            'isEmpty' => $cart->isEmpty(),
        ]);
    }

    public function store(StoreCartItemRequest $request, CartService $cart): RedirectResponse
    {
        $menu = Menu::query()->findOrFail($request->integer('menu_id'));
        $cart->add($menu, $request->integer('quantity'));

        return back()->with('success', 'Menu berhasil ditambahkan ke keranjang.');
    }

    public function update(UpdateCartItemRequest $request, Menu $menu, CartService $cart): RedirectResponse
    {
        $cart->update($menu, $request->integer('quantity'));

        return back()->with('success', 'Jumlah pesanan berhasil diperbarui.');
    }

    public function destroy(Menu $menu, CartService $cart): RedirectResponse
    {
        $cart->remove($menu);

        return back()->with('success', 'Menu berhasil dihapus dari keranjang.');
    }
}
