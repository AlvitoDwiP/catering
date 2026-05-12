<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMenuCategoryRequest;
use App\Http\Requests\Admin\UpdateMenuCategoryRequest;
use App\Models\MenuCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class MenuCategoryController extends Controller
{
    public function index(): View
    {
        $categories = MenuCategory::query()->withCount('menus')->latest()->paginate(10);

        return view('admin.menu-categories.index', compact('categories'));
    }

    public function create(): View
    {
        return view('admin.menu-categories.create');
    }

    public function store(StoreMenuCategoryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        MenuCategory::query()->create($data);

        return redirect()->route('admin.menu-categories.index')->with('success', 'Kategori menu berhasil ditambahkan.');
    }

    public function edit(MenuCategory $menuCategory): View
    {
        return view('admin.menu-categories.edit', compact('menuCategory'));
    }

    public function show(MenuCategory $menuCategory): RedirectResponse
    {
        return redirect()->route('admin.menu-categories.edit', $menuCategory);
    }

    public function update(UpdateMenuCategoryRequest $request, MenuCategory $menuCategory): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);

        $menuCategory->update($data);

        return redirect()->route('admin.menu-categories.index')->with('success', 'Kategori menu berhasil diperbarui.');
    }

    public function destroy(MenuCategory $menuCategory): RedirectResponse
    {
        if ($menuCategory->menus()->exists()) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih memiliki menu.');
        }

        $menuCategory->delete();

        return redirect()->route('admin.menu-categories.index')->with('success', 'Kategori menu berhasil dihapus.');
    }
}
