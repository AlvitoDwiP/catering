<x-admin-layout title="Pesanan">
    <x-admin-page-header title="Daftar Pesanan" description="Daftar pesanan masuk dari customer." />

    <x-card class="mb-5" padding="sm">
        <form method="GET" class="grid gap-3 md:grid-cols-5">
            <x-input name="search" label="Cari" :value="request('search')" placeholder="Invoice / customer / WhatsApp" />
            <div>
                <label class="text-sm font-medium text-nk-text">Status</label>
                <select name="status" class="mt-2 w-full rounded-xl border border-nk-border bg-white/80 px-4 py-3 text-sm">
                    <option value="">Semua</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status->value }}" @selected(request('status')===$status->value)>{{ $status->label() }}</option>
                    @endforeach
                </select>
            </div>
            <x-input name="event_date" type="date" label="Tanggal Acara" :value="request('event_date')" />
            <div class="flex items-end gap-2 md:col-span-2"><x-button type="submit">Filter</x-button><x-button variant="secondary" :href="route('admin.orders.index')">Reset</x-button></div>
        </form>
    </x-card>

    <x-admin-table>
        <thead class="bg-nk-alt/70 text-xs uppercase tracking-wide text-nk-muted"><tr><th class="px-4 py-3">Invoice</th><th class="px-4 py-3">Customer</th><th class="px-4 py-3">WhatsApp</th><th class="px-4 py-3">Jadwal</th><th class="px-4 py-3">Total</th><th class="px-4 py-3">Status</th><th class="px-4 py-3">Aksi</th></tr></thead>
        <tbody>
        @forelse($orders as $order)
            <tr class="border-t border-nk-border/80 align-top">
                <td class="px-4 py-3 font-medium">{{ $order->invoice_number }}</td>
                <td class="px-4 py-3 text-nk-muted">{{ $order->customer_name }}</td>
                <td class="px-4 py-3 text-nk-muted">{{ $order->customer_whatsapp }}</td>
                <td class="px-4 py-3 text-nk-muted"><x-date-time :date="$order->event_date" :time="$order->event_time" variant="compact" /></td>
                <td class="px-4 py-3 text-nk-muted"><x-price :amount="$order->total_amount" /></td>
                <td class="px-4 py-3"><x-status-badge :status="$order->status" /></td>
                <td class="px-4 py-3"><x-button :href="route('admin.orders.show', $order)" variant="secondary">Detail</x-button></td>
            </tr>
        @empty
            <tr><td colspan="7" class="px-4 py-6 text-center text-nk-muted">Belum ada pesanan.</td></tr>
        @endforelse
        </tbody>
    </x-admin-table>
    <div class="mt-4">{{ $orders->links() }}</div>
</x-admin-layout>
