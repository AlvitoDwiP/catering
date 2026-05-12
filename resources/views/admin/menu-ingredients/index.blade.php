<x-admin-layout title="Komposisi Menu">
    <x-admin-page-header title="Komposisi Menu" description="Atur bahan dan takaran per porsi untuk menu ini.">
        <x-button :href="route('admin.menus.ingredients.create', $menu)">Tambah Bahan</x-button>
    </x-admin-page-header>

    <x-card class="mb-5" padding="lg">
        <div class="grid gap-2 md:grid-cols-2">
            <p class="text-sm text-nk-muted">Nama menu: <span class="text-nk-text">{{ $menu->name }}</span></p>
            <p class="text-sm text-nk-muted">Kategori: <span class="text-nk-text">{{ $menu->category?->name ?: '-' }}</span></p>
            <p class="text-sm text-nk-muted">Harga: <span class="text-nk-text"><x-price :amount="$menu->price" /></span></p>
            <p class="text-sm text-nk-muted">Minimum order: <span class="text-nk-text">{{ $menu->minimum_order }} {{ $menu->unit }}</span></p>
        </div>
    </x-card>

    @if($menu->menuIngredients->isEmpty())
        <x-empty-state title="Komposisi bahan belum diatur." description="Tambahkan bahan agar sistem dapat menghitung kebutuhan produksi.">
            <x-button :href="route('admin.menus.ingredients.create', $menu)">Tambah Bahan</x-button>
        </x-empty-state>
    @else
        <x-admin-table>
            <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted">
            <tr>
                <th class="px-4 py-3">Bahan</th>
                <th class="px-4 py-3">Kategori</th>
                <th class="px-4 py-3">Jumlah per porsi</th>
                <th class="px-4 py-3">Satuan</th>
                <th class="px-4 py-3">Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($menu->menuIngredients as $menuIngredient)
                <tr class="border-t border-nk-border/80">
                    <td class="px-4 py-3">{{ $menuIngredient->ingredient?->name ?: '-' }}</td>
                    <td class="px-4 py-3 text-nk-muted">{{ $menuIngredient->ingredient?->category ?: '-' }}</td>
                    <td class="px-4 py-3 text-nk-muted">{{ number_format((float) $menuIngredient->quantity_per_portion, 2, '.', ',') }}</td>
                    <td class="px-4 py-3 text-nk-muted">{{ $menuIngredient->unit }}</td>
                    <td class="px-4 py-3">
                        <div class="flex gap-2">
                            <x-button :href="route('admin.menus.ingredients.edit', [$menu, $menuIngredient])" variant="secondary">Edit</x-button>
                            <form method="POST" action="{{ route('admin.menus.ingredients.destroy', [$menu, $menuIngredient]) }}" onsubmit="return confirm('Hapus komposisi bahan ini?')">
                                @csrf
                                @method('DELETE')
                                <x-button type="submit" variant="danger">Hapus</x-button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </x-admin-table>
    @endif
</x-admin-layout>
