<x-admin-layout title="Tambah Menu">
    <x-admin-page-header title="Tambah Menu" />
    @include('admin.menus.partials.form', ['action' => route('admin.menus.store'), 'method' => 'POST', 'menu' => null])
</x-admin-layout>
