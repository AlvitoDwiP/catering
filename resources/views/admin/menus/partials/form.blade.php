<x-card class="max-w-3xl" padding="lg">
    <form method="POST" action="{{ $action }}" enctype="multipart/form-data" class="space-y-4">
        @csrf
        @if($method !== 'POST') @method($method) @endif

        <div>
            <label class="text-sm font-medium text-nk-text">Kategori</label>
            <select name="menu_category_id" class="mt-2 w-full rounded-xl border border-nk-border bg-white/80 px-4 py-3 text-sm">
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('menu_category_id', $menu?->menu_category_id) == $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <x-input name="name" label="Nama" :value="old('name', $menu?->name)" />
        <x-textarea name="description" label="Deskripsi" :value="old('description', $menu?->description)" />
        <x-input name="price" type="number" step="0.01" label="Harga" :value="old('price', $menu?->price)" />
        <x-input name="unit" label="Unit" :value="old('unit', $menu?->unit ?? 'porsi')" />
        <x-input name="minimum_order" type="number" label="Minimum Order" :value="old('minimum_order', $menu?->minimum_order ?? 1)" />

        <div>
            <label class="text-sm font-medium text-nk-text">Foto Menu</label>
            <input type="file" name="image" class="mt-2 block w-full rounded-xl border border-nk-border bg-white/80 px-4 py-3 text-sm">
            @if($menu?->image)
                <img src="{{ $menu->image_url }}" alt="{{ $menu->name }}" class="mt-3 h-28 w-40 rounded object-cover">
            @endif
        </div>

        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_available" value="1" @checked(old('is_available', $menu?->is_available ?? true))> Tersedia</label>
        <label class="flex items-center gap-2 text-sm"><input type="checkbox" name="is_recommended" value="1" @checked(old('is_recommended', $menu?->is_recommended ?? false))> Rekomendasi</label>

        <div class="flex gap-2"><x-button type="submit">Simpan</x-button><x-button variant="secondary" :href="route('admin.menus.index')">Batal</x-button></div>
    </form>
</x-card>
