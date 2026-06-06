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
        $search = trim((string) request('q', ''));
        $sort = request('sort', 'recommended');

        $menusQuery = Menu::query()
            ->with('category')
            ->available()
            ->latest();

        if ($selectedCategory) {
            $menusQuery->whereHas('category', fn ($query) => $query->where('slug', $selectedCategory));
        }

        if ($search !== '') {
            $menusQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $menusQuery = match ($sort) {
            'price_asc' => $menusQuery->orderBy('price'),
            'price_desc' => $menusQuery->orderByDesc('price'),
            'name_asc' => $menusQuery->orderBy('name'),
            default => $menusQuery->orderByDesc('is_recommended')->orderByDesc('created_at'),
        };

        $menus = $menusQuery
            ->paginate(12)
            ->withQueryString();

        $categories = MenuCategory::query()
            ->orderByRaw("FIELD(slug, 'nasi-kotak', 'snack-box', 'minuman', 'paket-catering')")
            ->orderBy('name')
            ->get();

        return view('public.menus.index', compact('menus', 'categories', 'selectedCategory', 'search', 'sort'));
    }

    public function show(Menu $menu): View
    {
        abort_unless($menu->is_available, 404);

        $menu->load('category');

        return view('public.menus.show', compact('menu'));
    }
}
