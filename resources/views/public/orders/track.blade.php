<x-public-layout>
    <h1 class="font-heading text-4xl text-nk-text">Cek Status Pesanan</h1>
    <x-card class="mt-6" padding="lg">
        <form action="{{ route('public.orders.track.store') }}" method="POST" class="space-y-4">
            @csrf
            <x-input name="invoice_number" label="Nomor Invoice" placeholder="Contoh: NKS-20260512-0001" />
            <x-button type="submit">Cek Pesanan</x-button>
        </form>

        @isset($order)
            <div class="mt-6 rounded-2xl border border-nk-border bg-nk-alt p-5">
                @if ($order)
                    <div class="flex items-center justify-between">
                        <p class="font-semibold text-nk-text">{{ $order->invoice_number }}</p>
                        <x-status-badge :status="$order->status" />
                    </div>
                    <p class="mt-2 text-sm text-nk-muted">{{ $order->status->customerMessage() }}</p>
                @else
                    <p class="text-sm text-nk-error">Invoice tidak ditemukan.</p>
                @endif
            </div>
        @endisset
    </x-card>
</x-public-layout>
