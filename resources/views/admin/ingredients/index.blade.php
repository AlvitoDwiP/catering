<x-admin-layout title="Kelola Bahan">
    <x-admin-page-header title="Kelola Bahan" description="Atur data bahan untuk kebutuhan produksi.">
        <x-button :href="route('admin.ingredients.create')">Tambah Bahan</x-button>
    </x-admin-page-header>

    <x-card class="mb-5" padding="sm">
        <form method="GET" class="grid gap-3 md:grid-cols-4">
            <x-input name="search" label="Cari" :value="request('search')" placeholder="Nama bahan" />
            <div>
                <label class="text-sm font-medium text-nk-text">Kategori</label>
                <select name="category" class="mt-2 w-full rounded-xl border border-nk-border bg-white/80 px-4 py-3 text-sm">
                    <option value="">Semua kategori</option>
                    @foreach($categories as $category)
                        <option value="{{ $category }}" @selected(request('category') === $category)>{{ $category }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2 md:col-span-2">
                <x-button type="submit">Filter</x-button>
                <x-button variant="secondary" :href="route('admin.ingredients.index')">Reset</x-button>
            </div>
        </form>
    </x-card>

    <x-admin-table>
        <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted">
        <tr>
            <th class="px-4 py-3">Nama bahan</th>
            <th class="px-4 py-3">Satuan</th>
            <th class="px-4 py-3">Kategori</th>
            <th class="px-4 py-3">Dipakai di menu</th>
            <th class="px-4 py-3">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse($ingredients as $ingredient)
            <tr class="border-t border-nk-border/80">
                <td class="px-4 py-3">{{ $ingredient->name }}</td>
                <td class="px-4 py-3 text-nk-muted">{{ $ingredient->unit }}</td>
                <td class="px-4 py-3 text-nk-muted">{{ $ingredient->category ?: '-' }}</td>
                <td class="px-4 py-3 text-nk-muted">{{ $ingredient->menus_count }}</td>
                <td class="px-4 py-3">
                    <div class="flex gap-2">
                        <x-button :href="route('admin.ingredients.edit', $ingredient)" variant="secondary">Edit</x-button>
                        <form method="POST" action="{{ route('admin.ingredients.destroy', $ingredient) }}" onsubmit="return confirm('Hapus bahan ini?')">
                            @csrf
                            @method('DELETE')
                            <x-button type="submit" variant="danger">Hapus</x-button>
                        </form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="px-4 py-6 text-center text-nk-muted">Belum ada bahan.</td></tr>
        @endforelse
        </tbody>
    </x-admin-table>

    <div class="mt-4">{{ $ingredients->links() }}</div>
</x-admin-layout>
