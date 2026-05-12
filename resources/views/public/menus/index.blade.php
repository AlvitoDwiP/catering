<x-public-layout>
    <section class="space-y-6">
        <h1 class="font-heading text-4xl text-nk-text">Daftar Menu</h1>
        @forelse ($categories as $category)
            <x-card padding="lg">
                <h2 class="font-heading text-3xl text-nk-text">{{ $category->name }}</h2>
                @if ($category->description)
                    <p class="mt-1 text-sm text-nk-muted">{{ $category->description }}</p>
                @endif
                <div class="mt-5 grid gap-4 md:grid-cols-2">
                    @forelse ($category->menus as $menu)
                        <div class="rounded-2xl border border-nk-border bg-white/60 p-5">
                            <h3 class="font-semibold text-nk-text">{{ $menu->name }}</h3>
                            <p class="mt-1 text-sm text-nk-muted">{{ Str::limit($menu->description, 100) }}</p>
                            <div class="mt-3 flex items-center justify-between">
                                <x-price :amount="$menu->price" class="font-semibold text-nk-primary" />
                                <x-button variant="secondary" :href="route('public.menus.show', $menu)">Detail</x-button>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-nk-muted">Belum ada menu pada kategori ini.</p>
                    @endforelse
                </div>
            </x-card>
        @empty
            <x-empty-state title="Belum ada kategori" description="Kategori menu akan tampil di sini setelah data ditambahkan." />
        @endforelse
    </section>
</x-public-layout>
