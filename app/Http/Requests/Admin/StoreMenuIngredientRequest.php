<?php

namespace App\Http\Requests\Admin;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreMenuIngredientRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Menu $menu */
        $menu = $this->route('menu');

        return [
            'ingredient_id' => [
                'required',
                'exists:ingredients,id',
                Rule::unique('menu_ingredients', 'ingredient_id')->where(fn ($query) => $query->where('menu_id', $menu->id)),
            ],
            'quantity_per_portion' => ['required', 'numeric', 'min:0.01'],
        ];
    }

    public function messages(): array
    {
        return [
            'ingredient_id.unique' => 'Bahan ini sudah ada dalam komposisi menu.',
        ];
    }
}
