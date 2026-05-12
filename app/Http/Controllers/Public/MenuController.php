<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Contracts\View\View;

class MenuController extends Controller
{
    public function index(): View
    {
        $menus = Menu::query()
            ->with('category')
            ->available()
            ->latest()
            ->paginate(12)
            ->withQueryString();

        $categories = MenuCategory::query()->orderBy('name')->get();

        return view('public.menus.index', compact('menus', 'categories'));
    }

    public function show(Menu $menu): View
    {
        $menu->load('category');

        return view('public.menus.show', compact('menu'));
    }
}
