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
        $selectedCategory = request('category');

        $menusQuery = Menu::query()
            ->with('category')
            ->available()
            ->latest();

        if ($selectedCategory) {
            $menusQuery->whereHas('category', fn ($query) => $query->where('slug', $selectedCategory));
        }

        $menus = $menusQuery
            ->paginate(12)
            ->withQueryString();

        $categories = MenuCategory::query()
            ->orderByRaw("FIELD(slug, 'nasi-kotak', 'snack-box', 'minuman', 'paket-catering')")
            ->orderBy('name')
            ->get();

        return view('public.menus.index', compact('menus', 'categories', 'selectedCategory'));
    }

    public function show(Menu $menu): View
    {
        abort_unless($menu->is_available, 404);

        $menu->load('category');

        return view('public.menus.show', compact('menu'));
    }
}
