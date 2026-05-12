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

    protected function prepareForValidation(): void
    {
        $invoiceNumber = strtoupper(trim((string) $this->input('invoice_number')));

        $this->merge([
            'invoice_number' => $invoiceNumber,
        ]);
    }

    public function attributes(): array
    {
        return [
            'invoice_number' => 'nomor invoice',
        ];
    }
}
