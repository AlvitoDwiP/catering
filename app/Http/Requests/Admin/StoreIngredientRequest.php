<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreIngredientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('ingredients', 'name')->where(fn ($query) => $query->where('unit', $this->input('unit'))),
            ],
            'unit' => ['required', 'string', 'max:30'],
            'category' => ['nullable', 'string', 'max:100'],
            'notes' => ['nullable', 'string', 'max:500'],
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'name' => trim((string) $this->input('name')),
            'unit' => trim((string) $this->input('unit')),
            'category' => $this->filled('category') ? trim((string) $this->input('category')) : null,
            'notes' => $this->filled('notes') ? trim((string) $this->input('notes')) : null,
        ]);
    }

    public function messages(): array
    {
        return [
            'name.unique' => 'Kombinasi nama bahan dan satuan sudah digunakan.',
        ];
    }
}
