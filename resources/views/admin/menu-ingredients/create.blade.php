<x-admin-layout title="Tambah Komposisi Bahan">
    <x-admin-page-header title="Tambah Komposisi Bahan" description="Menu: {{ $menu->name }}">
        <x-button variant="secondary" :href="route('admin.menus.ingredients.index', $menu)">Kembali</x-button>
    </x-admin-page-header>

    @include('admin.menu-ingredients.partials_form', [
        'action' => route('admin.menus.ingredients.store', $menu),
        'method' => 'POST',
        'menuIngredient' => null,
        'menu' => $menu,
        'ingredients' => $ingredients,
    ])
</x-admin-layout>
