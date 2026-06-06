<x-public-layout>
    <h1 class="font-heading text-4xl text-nk-text">Cek Status Pesanan</h1>
    <x-card class="mt-6" padding="lg">
        <p class="mb-4 text-sm text-nk-muted">Masukkan nomor invoice yang diterima setelah checkout.</p>
        <form action="{{ route('public.orders.track.store') }}" method="POST" class="space-y-4">
            @csrf
            <x-input name="invoice_number" label="Nomor Invoice" placeholder="INV-20260512-001" />
            <x-button type="submit">Cek Status</x-button>
        </form>
    </x-card>
</x-public-layout>
