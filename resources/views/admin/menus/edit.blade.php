<x-admin-layout title="Edit Menu">
    <x-admin-page-header title="Edit Menu" />
    @include('admin.menus.partials.form', ['action' => route('admin.menus.update', $menu), 'method' => 'PUT', 'menu' => $menu])
</x-admin-layout>
