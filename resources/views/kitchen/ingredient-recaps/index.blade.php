<x-kitchen-layout title="Rekap Bahan Per Tanggal">
    <div class="mb-6 hidden print:block">
        <h1 class="font-heading text-4xl text-nk-text">Nad's Kitchen - Rekap Bahan Produksi</h1>
        <x-date-time label="Rekap Tanggal Acara" :date="$selectedDate" variant="compact" class="mt-1" />
    </div>

    <div class="print:hidden">
        <x-admin-page-header title="Rekap Bahan Per Tanggal" />

        <x-card class="mb-5" padding="sm">
            <form method="GET" class="grid gap-3 md:grid-cols-3">
                <x-input type="date" name="date" label="Tanggal Acara" :value="$selectedDate" />
                <div class="flex items-end gap-2 md:col-span-2">
                    <x-button type="submit">Tampilkan</x-button>
                    <x-button :href="route('kitchen.ingredient-recaps.index')" variant="secondary">Hari Ini</x-button>
                    <x-button href="javascript:window.print()">Print Daftar Bahan</x-button>
                </div>
            </form>
            <p class="mt-3 text-sm text-nk-muted">Rekap bahan dihitung berdasarkan jadwal acara (`event_date`) untuk pesanan berstatus dikonfirmasi dan diproses.</p>
        </x-card>
    </div>

    <div class="grid gap-4 md:grid-cols-3">
        <x-card padding="lg"><x-date-time label="Tanggal Acara" :date="$selectedDate" variant="default" /></x-card>
        <x-card padding="lg"><p class="text-sm text-nk-muted">Jumlah pesanan</p><p class="mt-2 font-heading text-3xl text-nk-primary">{{ $orders->count() }}</p></x-card>
        <x-card padding="lg"><p class="text-sm text-nk-muted">Jumlah jenis bahan</p><p class="mt-2 font-heading text-3xl text-nk-primary">{{ $ingredientRecap->count() }}</p></x-card>
    </div>

    @if($missingBomOrders->isNotEmpty())
        <div class="mt-6 rounded-xl border border-nk-error/30 bg-nk-error/5 p-4">
            <p class="text-sm text-nk-error">Ada order/menu tanpa BOM pada tanggal ini. Rekap bahan mungkin belum lengkap.</p>
        </div>
    @endif

    <section class="mt-6">
        <h3 class="mb-3 font-heading text-2xl">Daftar Order</h3>
        <x-admin-table>
            <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted"><tr><th class="px-4 py-3">Invoice</th><th class="px-4 py-3">Customer</th><th class="px-4 py-3">Jadwal acara</th><th class="px-4 py-3">Menu ringkas</th><th class="px-4 py-3">Status</th></tr></thead>
            <tbody>
            @forelse($orders as $order)
                <tr class="border-t border-nk-border/80 align-top">
                    <td class="px-4 py-3">{{ $order->invoice_number }}</td>
                    <td class="px-4 py-3">{{ $order->customer_name }}</td>
                    <td class="px-4 py-3 text-nk-muted"><x-date-time :date="$order->event_date" :time="$order->event_time" variant="compact" /></td>
                    <td class="px-4 py-3 text-sm text-nk-muted">{{ $order->items->pluck('menu_name')->take(2)->implode(', ') }}{{ $order->items->count() > 2 ? '...' : '' }}</td>
                    <td class="px-4 py-3"><x-status-badge :status="$order->status" /></td>
                </tr>
            @empty
                <tr><td colspan="5" class="px-4 py-6 text-center text-nk-muted">Tidak ada order berstatus dikonfirmasi/diproses untuk tanggal acara yang dipilih.</td></tr>
            @endforelse
            </tbody>
        </x-admin-table>
    </section>

    <section class="mt-6">
        <h3 class="mb-3 font-heading text-2xl">Total Bahan Gabungan</h3>
        <x-admin-table>
            <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted"><tr><th class="px-4 py-3">Bahan</th><th class="px-4 py-3">Total kebutuhan</th><th class="px-4 py-3">Satuan</th></tr></thead>
            <tbody>
            @forelse($ingredientRecap as $item)
                <tr class="border-t border-nk-border/80"><td class="px-4 py-3">{{ $item['ingredient_name'] }}</td><td class="px-4 py-3 text-nk-muted"><x-ingredient-qty :value="$item['total_quantity']" :unit="$item['ingredient_unit']" /></td><td class="px-4 py-3 text-nk-muted">{{ $item['ingredient_unit'] }}</td></tr>
            @empty
                <tr><td colspan="3" class="px-4 py-6 text-center text-nk-muted">Belum ada data kebutuhan bahan.</td></tr>
            @endforelse
            </tbody>
        </x-admin-table>
    </section>
</x-kitchen-layout>
