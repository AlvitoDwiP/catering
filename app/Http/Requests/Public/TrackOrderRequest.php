<?php

namespace App\Http\Requests\Public;

use Illuminate\Foundation\Http\FormRequest;

class TrackOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'invoice_number' => ['required', 'string', 'max:50'],
        ];
    }

    public function attributes(): array
    {
        return [
            'invoice_number' => 'nomor invoice',
        ];
    }
}
