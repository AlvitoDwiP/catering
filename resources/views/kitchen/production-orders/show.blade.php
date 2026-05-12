<x-kitchen-layout title="Detail Produksi Pesanan">
    <x-admin-page-header title="Detail Produksi Pesanan" description="{{ $order->invoice_number }}" />

    <div class="grid gap-4 lg:grid-cols-2">
        <x-card class="space-y-2" padding="lg">
            <h3 class="font-heading text-2xl">Data Acara</h3>
            <p class="text-sm text-nk-muted">Tanggal: {{ $order->event_date?->format('d M Y') }}</p>
            <p class="text-sm text-nk-muted">Jam: {{ $order->event_time }}</p>
            <p class="text-sm text-nk-muted">Alamat: {{ $order->event_address }}</p>
            <p class="text-sm text-nk-muted">Catatan customer: {{ $order->notes ?: '-' }}</p>
        </x-card>

        <x-card class="space-y-2" padding="lg">
            <h3 class="font-heading text-2xl">Data Customer</h3>
            <p class="text-sm text-nk-muted">Nama: {{ $order->customer_name }}</p>
            <p class="text-sm text-nk-muted">WhatsApp: {{ $order->customer_whatsapp }}</p>
            <p class="text-sm text-nk-muted">Status: {{ $order->status->label() }}</p>
        </x-card>
    </div>

    <section class="mt-6">
        <x-admin-table>
            <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted"><tr><th class="px-4 py-3">Menu</th><th class="px-4 py-3">Quantity</th><th class="px-4 py-3">Unit</th></tr></thead>
            <tbody>
            @foreach($order->items as $item)
                <tr class="border-t border-nk-border/80"><td class="px-4 py-3">{{ $item->menu_name }}</td><td class="px-4 py-3 text-nk-muted">{{ $item->quantity }}</td><td class="px-4 py-3 text-nk-muted">{{ $item->menu?->unit ?? 'porsi' }}</td></tr>
            @endforeach
            </tbody>
        </x-admin-table>
    </section>

    <section class="mt-6 space-y-4">
        <x-card padding="lg" class="space-y-3">
            <h3 class="font-heading text-2xl">Kebutuhan Bahan</h3>

            @if($hasMissingBom)
                <div class="rounded-xl border border-nk-error/30 bg-nk-error/5 p-4">
                    <p class="text-sm text-nk-error">Beberapa menu belum memiliki komposisi bahan sehingga perhitungan belum lengkap.</p>
                    <ul class="mt-2 list-disc pl-5 text-sm text-nk-muted">
                        @foreach($missingBomMenus as $missingMenu)
                            <li>{{ $missingMenu['menu_name'] }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <x-admin-table>
                <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted"><tr><th class="px-4 py-3">Bahan</th><th class="px-4 py-3">Total kebutuhan</th><th class="px-4 py-3">Satuan</th><th class="px-4 py-3">Detail pemakaian</th></tr></thead>
                <tbody>
                @forelse($ingredientNeeds as $need)
                    <tr class="border-t border-nk-border/80 align-top">
                        <td class="px-4 py-3">{{ $need['ingredient_name'] }}</td>
                        <td class="px-4 py-3 text-nk-muted">{{ number_format((float) $need['total_quantity'], 2, '.', ',') }}</td>
                        <td class="px-4 py-3 text-nk-muted">{{ $need['ingredient_unit'] }}</td>
                        <td class="px-4 py-3 text-sm text-nk-muted">
                            @foreach($need['details'] as $detail)
                                <p>{{ $detail['menu_name'] }}: {{ number_format((float) $detail['quantity_per_portion'], 2, '.', ',') }} {{ $detail['unit'] }} x {{ $detail['order_quantity'] }} porsi = {{ number_format((float) $detail['total_quantity'], 2, '.', ',') }} {{ $detail['unit'] }}</p>
                            @endforeach
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="px-4 py-6 text-center text-nk-muted">Belum ada data BOM untuk pesanan ini.</td></tr>
                @endforelse
                </tbody>
            </x-admin-table>
        </x-card>
    </section>

    <div class="mt-6 flex gap-2 print:hidden">
        <x-button :href="route('kitchen.production-orders.index')" variant="secondary">Kembali</x-button>
        <x-button href="javascript:window.print()">Print Detail Produksi</x-button>
    </div>
</x-kitchen-layout>
