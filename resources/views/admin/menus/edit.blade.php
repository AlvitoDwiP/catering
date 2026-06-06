<x-admin-layout title="Edit Menu">
    <x-admin-page-header title="Edit Menu" />
    @if(! $menu->menuIngredients()->exists())
        <div class="mb-4 rounded-xl border border-nk-warning/30 bg-nk-warning/10 p-3 text-sm text-nk-text">
            Menu ini belum memiliki komposisi bahan/BOM. Tambahkan bahan agar kebutuhan produksi dapat dihitung.
        </div>
    @endif
    @include('admin.menus.partials.form', ['action' => route('admin.menus.update', $menu), 'method' => 'PUT', 'menu' => $menu])
</x-admin-layout>
