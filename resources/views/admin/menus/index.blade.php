<x-admin-layout title="Menu">
    <x-admin-page-header title="Menu">
        <x-button :href="route('admin.menus.create')">Tambah Menu</x-button>
    </x-admin-page-header>

    <x-card class="mb-5" padding="sm">
        <form method="GET" class="grid gap-3 md:grid-cols-4">
            <x-input name="search" label="Cari" :value="request('search')" placeholder="Nama menu" />
            <div>
                <label class="text-sm font-medium text-nk-text">Kategori</label>
                <select name="category" class="mt-2 w-full rounded-xl border border-nk-border bg-white/80 px-4 py-3 text-sm">
                    <option value="">Semua</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(request('category')==$category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="text-sm font-medium text-nk-text">Ketersediaan</label>
                <select name="availability" class="mt-2 w-full rounded-xl border border-nk-border bg-white/80 px-4 py-3 text-sm">
                    <option value="">Semua</option>
                    <option value="1" @selected(request('availability')==='1')>Aktif</option>
                    <option value="0" @selected(request('availability')==='0')>Nonaktif</option>
                </select>
            </div>
            <div class="flex items-end gap-2"><x-button type="submit">Filter</x-button><x-button variant="secondary" :href="route('admin.menus.index')">Reset</x-button></div>
        </form>
    </x-card>

    <x-admin-table>
        <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted"><tr><th class="px-4 py-3">Foto</th><th class="px-4 py-3">Nama</th><th class="px-4 py-3">Kategori</th><th class="px-4 py-3">Harga</th><th class="px-4 py-3">Min. Order</th><th class="px-4 py-3">Tersedia</th><th class="px-4 py-3">Rekomendasi</th><th class="px-4 py-3">BOM</th><th class="px-4 py-3">Aksi</th></tr></thead>
        <tbody>
        @forelse($menus as $menu)
            <tr class="border-t border-nk-border/80">
                <td class="px-4 py-3"><img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="h-14 w-20 rounded object-cover"></td>
                <td class="px-4 py-3">{{ $menu->name }}</td>
                <td class="px-4 py-3 text-nk-muted">{{ $menu->category?->name }}</td>
                <td class="px-4 py-3 text-nk-muted"><x-price :amount="$menu->price" /></td>
                <td class="px-4 py-3 text-nk-muted">{{ $menu->minimum_order }} {{ $menu->unit }}</td>
                <td class="px-4 py-3">{!! $menu->is_available ? '<span class="text-nk-success">Aktif</span>' : '<span class="text-nk-error">Nonaktif</span>' !!}</td>
                <td class="px-4 py-3">{!! $menu->is_recommended ? '<span class="text-nk-primary">Ya</span>' : '<span class="text-nk-muted">Tidak</span>' !!}</td>
                <td class="px-4 py-3">
                    @if($menu->menu_ingredients_count > 0)
                        <span class="rounded-full bg-nk-success/10 px-3 py-1 text-xs font-medium text-nk-success">BOM lengkap</span>
                    @else
                        <span class="rounded-full bg-nk-error/10 px-3 py-1 text-xs font-medium text-nk-error">BOM kosong</span>
                    @endif
                </td>
                <td class="px-4 py-3">
                    <div class="flex flex-wrap gap-2">
                        <x-button :href="route('admin.menus.ingredients.index', $menu)" variant="secondary">Komposisi</x-button>
                        <x-button :href="route('admin.menus.edit',$menu)" variant="secondary">Edit</x-button>
                        <form method="POST" action="{{ route('admin.menus.destroy',$menu) }}">@csrf @method('DELETE')<x-button type="submit" variant="danger">Nonaktifkan</x-button></form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="9" class="px-4 py-6 text-center text-nk-muted">Belum ada menu.</td></tr>
        @endforelse
        </tbody>
    </x-admin-table>
    <div class="mt-4">{{ $menus->links() }}</div>
</x-admin-layout>
