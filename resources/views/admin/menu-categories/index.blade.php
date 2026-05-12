<x-admin-layout title="Kategori Menu">
    <x-admin-page-header title="Kategori Menu" description="Kelola kategori menu Nad's Kitchen.">
        <x-button :href="route('admin.menu-categories.create')">Tambah Kategori</x-button>
    </x-admin-page-header>

    <x-admin-table>
        <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted">
        <tr>
            <th class="px-4 py-3">Nama</th><th class="px-4 py-3">Slug</th><th class="px-4 py-3">Deskripsi</th><th class="px-4 py-3">Jumlah Menu</th><th class="px-4 py-3">Aksi</th>
        </tr>
        </thead>
        <tbody>
        @forelse($categories as $category)
            <tr class="border-t border-nk-border/80">
                <td class="px-4 py-3">{{ $category->name }}</td>
                <td class="px-4 py-3 text-nk-muted">{{ $category->slug }}</td>
                <td class="px-4 py-3 text-nk-muted">{{ $category->description ?: '-' }}</td>
                <td class="px-4 py-3 text-nk-muted">{{ $category->menus_count }}</td>
                <td class="px-4 py-3">
                    <div class="flex gap-2">
                        <x-button :href="route('admin.menu-categories.edit', $category)" variant="secondary">Edit</x-button>
                        <form method="POST" action="{{ route('admin.menu-categories.destroy', $category) }}">@csrf @method('DELETE')<x-button type="submit" variant="danger">Hapus</x-button></form>
                    </div>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="px-4 py-6 text-center text-nk-muted">Belum ada kategori.</td></tr>
        @endforelse
        </tbody>
    </x-admin-table>
    <div class="mt-4">{{ $categories->links() }}</div>
</x-admin-layout>
