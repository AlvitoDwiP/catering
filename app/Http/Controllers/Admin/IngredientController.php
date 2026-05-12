<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIngredientRequest;
use App\Http\Requests\Admin\UpdateIngredientRequest;
use App\Models\Ingredient;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class IngredientController extends Controller
{
    public function index(): View
    {
        $ingredients = Ingredient::query()
            ->withCount('menus')
            ->search(request('search'))
            ->byCategory(request('category'))
            ->orderBy('name')
            ->paginate(15)
            ->withQueryString();

        $categories = Ingredient::query()
            ->whereNotNull('category')
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('admin.ingredients.index', compact('ingredients', 'categories'));
    }

    public function create(): View
    {
        return view('admin.ingredients.create');
    }

    public function store(StoreIngredientRequest $request): RedirectResponse
    {
        Ingredient::query()->create($request->validated());

        return redirect()->route('admin.ingredients.index')->with('success', 'Bahan berhasil ditambahkan.');
    }

    public function edit(Ingredient $ingredient): View
    {
        return view('admin.ingredients.edit', compact('ingredient'));
    }

    public function update(UpdateIngredientRequest $request, Ingredient $ingredient): RedirectResponse
    {
        $ingredient->update($request->validated());

        return redirect()->route('admin.ingredients.index')->with('success', 'Bahan berhasil diperbarui.');
    }

    public function destroy(Ingredient $ingredient): RedirectResponse
    {
        if ($ingredient->menuIngredients()->exists()) {
            return back()->with('error', 'Bahan tidak dapat dihapus karena masih digunakan dalam komposisi menu.');
        }

        $ingredient->delete();

        return redirect()->route('admin.ingredients.index')->with('success', 'Bahan berhasil dihapus.');
    }
}
