<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Services\Cart\CartService;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function __invoke(CartService $cart): View
    {
        $recommendedMenus = Menu::query()
            ->available()
            ->recommended()
            ->latest()
            ->take(4)
            ->get();

        return view('public.home', [
            'recommendedMenus' => $recommendedMenus,
            'cartCount' => $cart->count(),
            'cartTotal' => $cart->totalAmount(),
            'cartItems' => $cart->all(),
        ]);
    }
}
