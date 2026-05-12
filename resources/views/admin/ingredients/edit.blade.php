<x-admin-layout title="Edit Bahan">
    <x-admin-page-header title="Edit Bahan" description="Perbarui data bahan.">
        <x-button variant="secondary" :href="route('admin.ingredients.index')">Kembali</x-button>
    </x-admin-page-header>

    @include('admin.ingredients.partials_form', [
        'action' => route('admin.ingredients.update', $ingredient),
        'method' => 'PUT',
        'ingredient' => $ingredient,
    ])
</x-admin-layout>
