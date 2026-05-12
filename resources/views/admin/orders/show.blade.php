<x-admin-layout title="Detail Pesanan">
    <x-admin-page-header title="Detail Pesanan" description="{{ $order->invoice_number }}" />

    <div class="grid gap-4 lg:grid-cols-3">
        <x-card class="space-y-2" padding="lg">
            <h3 class="font-heading text-2xl">Data Customer</h3>
            <p class="text-sm text-nk-muted">Nama: {{ $order->customer_name }}</p>
            <p class="text-sm text-nk-muted">WhatsApp: {{ $order->customer_whatsapp }}</p>
        </x-card>

        <x-card class="space-y-2" padding="lg">
            <h3 class="font-heading text-2xl">Data Acara</h3>
            <p class="text-sm text-nk-muted">Alamat: {{ $order->event_address }}</p>
            <p class="text-sm text-nk-muted">Tanggal: {{ $order->event_date?->format('d M Y') }}</p>
            <p class="text-sm text-nk-muted">Jam: {{ $order->event_time }}</p>
            <p class="text-sm text-nk-muted">Catatan: {{ $order->notes ?: '-' }}</p>
        </x-card>

        <x-card class="space-y-3" padding="lg">
            <h3 class="font-heading text-2xl">Status</h3>
            <x-status-badge :status="$order->status" />
            <form method="POST" action="{{ route('admin.orders.update-status', $order) }}" class="space-y-3">
                @csrf @method('PATCH')
                <select name="status" class="w-full rounded-xl border border-nk-border bg-white/80 px-4 py-3 text-sm">
                    @foreach($statuses as $status)
                        <option value="{{ $status->value }}" @selected($order->status === $status)>{{ $status->label() }}</option>
                    @endforeach
                </select>
                <x-button type="submit">Update Status</x-button>
            </form>
        </x-card>
    </div>

    <section class="mt-6">
        <x-admin-table>
            <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted"><tr><th class="px-4 py-3">Menu</th><th class="px-4 py-3">Harga</th><th class="px-4 py-3">Quantity</th><th class="px-4 py-3">Subtotal</th></tr></thead>
            <tbody>
            @foreach($order->items as $item)
                <tr class="border-t border-nk-border/80">
                    <td class="px-4 py-3">{{ $item->menu_name }}</td>
                    <td class="px-4 py-3 text-nk-muted"><x-price :amount="$item->price" /></td>
                    <td class="px-4 py-3 text-nk-muted">{{ $item->quantity }}</td>
                    <td class="px-4 py-3 text-nk-muted"><x-price :amount="$item->subtotal" /></td>
                </tr>
            @endforeach
            </tbody>
        </x-admin-table>
        <div class="mt-4 flex flex-wrap items-center justify-between gap-2">
            <p class="font-heading text-3xl text-nk-primary">Total: <x-price :amount="$order->total_amount" /></p>
            <div class="flex gap-2">
                <x-button :href="route('admin.invoices.show', $order)">Lihat Invoice</x-button>
                <x-button :href="$whatsAppUrl" variant="secondary">Hubungi Customer</x-button>
                <x-button :href="route('admin.orders.index')" variant="secondary">Kembali</x-button>
            </div>
        </div>
    </section>
</x-admin-layout>
