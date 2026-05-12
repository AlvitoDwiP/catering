<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMenuRequest;
use App\Http\Requests\Admin\UpdateMenuRequest;
use App\Models\Menu;
use App\Models\MenuCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MenuController extends Controller
{
    public function index(): View
    {
        $menus = Menu::query()
            ->with('category')
            ->withCount('menuIngredients')
            ->when(request('search'), fn ($q, $search) => $q->where('name', 'like', "%{$search}%"))
            ->when(request('category'), fn ($q, $category) => $q->where('menu_category_id', $category))
            ->when(request()->filled('availability'), fn ($q) => $q->where('is_available', request('availability') === '1'))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $categories = MenuCategory::query()->orderBy('name')->get();

        return view('admin.menus.index', compact('menus', 'categories'));
    }

    public function create(): View
    {
        $categories = MenuCategory::query()->orderBy('name')->get();

        return view('admin.menus.create', compact('categories'));
    }

    public function store(StoreMenuRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        $data['is_available'] = $request->boolean('is_available');
        $data['is_recommended'] = $request->boolean('is_recommended');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        Menu::query()->create($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil ditambahkan.');
    }

    public function edit(Menu $menu): View
    {
        $categories = MenuCategory::query()->orderBy('name')->get();

        return view('admin.menus.edit', compact('menu', 'categories'));
    }

    public function show(Menu $menu): RedirectResponse
    {
        return redirect()->route('admin.menus.edit', $menu);
    }

    public function update(UpdateMenuRequest $request, Menu $menu): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['name']);
        $data['is_available'] = $request->boolean('is_available');
        $data['is_recommended'] = $request->boolean('is_recommended');

        if ($request->hasFile('image')) {
            if ($menu->image) {
                Storage::disk('public')->delete($menu->image);
            }
            $data['image'] = $request->file('image')->store('menus', 'public');
        }

        $menu->update($data);

        return redirect()->route('admin.menus.index')->with('success', 'Menu berhasil diperbarui.');
    }

    public function destroy(Menu $menu): RedirectResponse
    {
        $menu->update(['is_available' => false]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu dinonaktifkan.');
    }
}
