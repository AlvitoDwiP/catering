<x-card class="max-w-3xl" padding="lg">
    <form method="POST" action="{{ $action }}" class="space-y-4">
        @csrf
        @if($method !== 'POST') @method($method) @endif

        <x-input name="name" label="Nama Bahan" :value="old('name', $ingredient?->name)" />
        <x-input name="unit" label="Satuan" :value="old('unit', $ingredient?->unit)" placeholder="gram / pcs / potong" />
        <x-input name="category" label="Kategori" :value="old('category', $ingredient?->category)" />
        <x-textarea name="notes" label="Catatan" :value="old('notes', $ingredient?->notes)" />

        <div class="flex gap-2">
            <x-button type="submit">Simpan</x-button>
            <x-button variant="secondary" :href="route('admin.ingredients.index')">Batal</x-button>
        </div>
    </form>
</x-card>
