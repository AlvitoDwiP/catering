<x-public-layout>
    <h1 class="font-heading text-4xl text-nk-text">Keranjang</h1>
    <div class="mt-6">
        <x-empty-state title="Keranjang masih kosong" description="Fitur session-based cart akan dilanjutkan pada sprint berikutnya.">
            <x-button :href="route('public.menus.index')">Mulai Pilih Menu</x-button>
        </x-empty-state>
    </div>
</x-public-layout>
