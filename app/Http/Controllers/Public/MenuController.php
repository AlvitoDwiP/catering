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
        $categories = MenuCategory::query()->with(['menus' => fn ($query) => $query->available()])->get();

        return view('public.menus.index', compact('categories'));
    }

    public function show(Menu $menu): View
    {
        return view('public.menus.show', compact('menu'));
    }
}
