<x-public-layout>
    <h1 class="font-heading text-4xl text-nk-text">Checkout</h1>
    <x-card class="mt-6" padding="lg">
        <form method="POST" action="{{ route('public.checkout.review') }}" class="space-y-4">
            @csrf
            <x-input name="customer_name" label="Nama Pemesan" placeholder="Contoh: Nadia Putri" />
            <x-input name="customer_whatsapp" label="WhatsApp" placeholder="Contoh: 08123456789" />
            <x-input name="event_date" label="Tanggal Acara" type="date" />
            <x-input name="event_time" label="Jam Acara" type="time" />
            <x-textarea name="event_address" label="Alamat Acara" placeholder="Tulis alamat lengkap acara" />
            <x-textarea name="notes" label="Catatan Tambahan" placeholder="Opsional" />
            <x-button type="submit">Review Pesanan</x-button>
        </form>
    </x-card>
</x-public-layout>
