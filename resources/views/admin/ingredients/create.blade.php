<x-admin-layout title="Tambah Bahan">
    <x-admin-page-header title="Tambah Bahan" description="Tambahkan data bahan baru.">
        <x-button variant="secondary" :href="route('admin.ingredients.index')">Kembali</x-button>
    </x-admin-page-header>

    @include('admin.ingredients.partials_form', [
        'action' => route('admin.ingredients.store'),
        'method' => 'POST',
        'ingredient' => null,
    ])
</x-admin-layout>
