<?php

namespace App\Http\Requests\Public;

use Illuminate\Foundation\Http\FormRequest;

class StoreCheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_name' => ['required', 'string', 'max:100'],
            'customer_whatsapp' => ['required', 'string', 'max:30'],
            'event_address' => ['required', 'string', 'max:500'],
            'event_date' => ['required', 'date', 'after_or_equal:tomorrow'],
            'event_time' => ['required', 'date_format:H:i'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function attributes(): array
    {
        return [
            'customer_name' => 'nama pemesan',
            'customer_whatsapp' => 'nomor WhatsApp',
            'event_address' => 'alamat acara',
            'event_date' => 'tanggal acara',
            'event_time' => 'jam acara',
            'notes' => 'catatan tambahan',
        ];
    }
}
