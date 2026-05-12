<?php

namespace App\Http\Requests\Admin;

use App\Models\Ingredient;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateIngredientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Ingredient $ingredient */
        $ingredient = $this->route('ingredient');

        return [
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('ingredients', 'name')
                    ->where(fn ($query) => $query->where('unit', $this->input('unit')))
                    ->ignore($ingredient->id),
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
