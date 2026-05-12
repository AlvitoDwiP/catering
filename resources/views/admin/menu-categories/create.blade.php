<x-admin-layout title="Tambah Kategori Menu">
    <x-admin-page-header title="Tambah Kategori Menu" />
    <x-card class="max-w-2xl" padding="lg">
        <form method="POST" action="{{ route('admin.menu-categories.store') }}" class="space-y-4">
            @csrf
            <x-input name="name" label="Nama" />
            <x-textarea name="description" label="Deskripsi" />
            <div class="flex gap-2"><x-button type="submit">Simpan</x-button><x-button variant="secondary" :href="route('admin.menu-categories.index')">Batal</x-button></div>
        </form>
    </x-card>
</x-admin-layout>
