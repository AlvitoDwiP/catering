<x-card class="max-w-3xl" padding="lg">
    <form method="POST" action="{{ $action }}" class="space-y-4">
        @csrf
        @if($method !== 'POST') @method($method) @endif

        <div>
            <label class="text-sm font-medium text-nk-text">Bahan</label>
            <select name="ingredient_id" class="mt-2 w-full rounded-xl border border-nk-border bg-white/80 px-4 py-3 text-sm">
                <option value="">Pilih bahan</option>
                @foreach($ingredients as $ingredientOption)
                    <option value="{{ $ingredientOption->id }}" @selected((string) old('ingredient_id', $menuIngredient?->ingredient_id) === (string) $ingredientOption->id)>
                        {{ $ingredientOption->name }} ({{ $ingredientOption->unit }})
                    </option>
                @endforeach
            </select>
            <p class="mt-2 text-xs text-nk-muted">Satuan komposisi otomatis mengikuti satuan bahan.</p>
        </div>

        <x-input name="quantity_per_portion" type="number" step="0.01" label="Jumlah per porsi" :value="old('quantity_per_portion', $menuIngredient?->quantity_per_portion)" />

        @if($menuIngredient)
            <p class="text-sm text-nk-muted">Satuan saat ini: {{ $menuIngredient->unit }}</p>
        @endif

        <div class="flex gap-2">
            <x-button type="submit">Simpan</x-button>
            <x-button variant="secondary" :href="route('admin.menus.ingredients.index', $menu)">Batal</x-button>
        </div>
    </form>
</x-card>
