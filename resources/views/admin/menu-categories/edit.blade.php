<x-admin-layout title="Edit Kategori Menu">
    <x-admin-page-header title="Edit Kategori Menu" />
    <x-card class="max-w-2xl" padding="lg">
        <form method="POST" action="{{ route('admin.menu-categories.update', $menuCategory) }}" class="space-y-4">
            @csrf @method('PUT')
            <x-input name="name" label="Nama" :value="$menuCategory->name" />
            <x-textarea name="description" label="Deskripsi" :value="$menuCategory->description" />
            <div class="flex gap-2"><x-button type="submit">Simpan</x-button><x-button variant="secondary" :href="route('admin.menu-categories.index')">Batal</x-button></div>
        </form>
    </x-card>
</x-admin-layout>
