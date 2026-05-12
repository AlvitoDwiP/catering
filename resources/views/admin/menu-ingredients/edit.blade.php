<x-admin-layout title="Edit Komposisi Bahan">
    <x-admin-page-header title="Edit Komposisi Bahan" description="Menu: {{ $menu->name }}">
        <x-button variant="secondary" :href="route('admin.menus.ingredients.index', $menu)">Kembali</x-button>
    </x-admin-page-header>

    @include('admin.menu-ingredients.partials_form', [
        'action' => route('admin.menus.ingredients.update', [$menu, $menuIngredient]),
        'method' => 'PUT',
        'menuIngredient' => $menuIngredient,
        'menu' => $menu,
        'ingredients' => $ingredients,
    ])
</x-admin-layout>
