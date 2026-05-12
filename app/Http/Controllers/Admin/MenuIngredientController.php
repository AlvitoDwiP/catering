<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMenuIngredientRequest;
use App\Http\Requests\Admin\UpdateMenuIngredientRequest;
use App\Models\Ingredient;
use App\Models\Menu;
use App\Models\MenuIngredient;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class MenuIngredientController extends Controller
{
    public function index(Menu $menu): View
    {
        $menu->load(['category', 'menuIngredients.ingredient']);

        return view('admin.menu-ingredients.index', compact('menu'));
    }

    public function create(Menu $menu): View
    {
        $ingredients = Ingredient::query()->orderBy('name')->get();

        return view('admin.menu-ingredients.create', compact('menu', 'ingredients'));
    }

    public function store(StoreMenuIngredientRequest $request, Menu $menu): RedirectResponse
    {
        $ingredient = Ingredient::query()->findOrFail($request->integer('ingredient_id'));

        $menu->menuIngredients()->create([
            'ingredient_id' => $ingredient->id,
            'quantity_per_portion' => $request->input('quantity_per_portion'),
            'unit' => $ingredient->unit,
        ]);

        return redirect()->route('admin.menus.ingredients.index', $menu)->with('success', 'Komposisi bahan berhasil ditambahkan.');
    }

    public function edit(Menu $menu, MenuIngredient $menuIngredient): View
    {
        abort_unless($menuIngredient->menu_id === $menu->id, 404);

        $ingredients = Ingredient::query()->orderBy('name')->get();

        return view('admin.menu-ingredients.edit', compact('menu', 'menuIngredient', 'ingredients'));
    }

    public function update(UpdateMenuIngredientRequest $request, Menu $menu, MenuIngredient $menuIngredient): RedirectResponse
    {
        abort_unless($menuIngredient->menu_id === $menu->id, 404);

        $ingredient = Ingredient::query()->findOrFail($request->integer('ingredient_id'));

        $menuIngredient->update([
            'ingredient_id' => $ingredient->id,
            'quantity_per_portion' => $request->input('quantity_per_portion'),
            'unit' => $ingredient->unit,
        ]);

        return redirect()->route('admin.menus.ingredients.index', $menu)->with('success', 'Komposisi bahan berhasil diperbarui.');
    }

    public function destroy(Menu $menu, MenuIngredient $menuIngredient): RedirectResponse
    {
        abort_unless($menuIngredient->menu_id === $menu->id, 404);

        $menuIngredient->delete();

        return redirect()->route('admin.menus.ingredients.index', $menu)->with('success', 'Komposisi bahan berhasil dihapus.');
    }
}
