<x-public-layout>
    <h1 class="font-heading text-4xl text-nk-text">Review Checkout</h1>
    <x-card class="mt-6 space-y-3" padding="lg">
        <p class="text-sm text-nk-muted">Halaman review detail akan diperkaya di Prompt 2.</p>
        @if (!empty($validated))
            <div class="rounded-xl bg-nk-alt p-4 text-sm text-nk-text">
                <p>Nama: {{ $validated['customer_name'] ?? '-' }}</p>
                <p>WhatsApp: {{ $validated['customer_whatsapp'] ?? '-' }}</p>
                <p>Tanggal Acara: {{ $validated['event_date'] ?? '-' }}</p>
                <p>Jam Acara: {{ $validated['event_time'] ?? '-' }}</p>
            </div>
        @endif
        <x-button variant="secondary" :href="route('public.checkout.create')">Kembali</x-button>
    </x-card>
</x-public-layout>
