<?php

namespace App\Http\Requests\Admin;

use App\Models\MenuCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMenuCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var MenuCategory $menuCategory */
        $menuCategory = $this->route('menu_category');

        return [
            'name' => ['required', 'string', 'max:100', Rule::unique('menu_categories', 'name')->ignore($menuCategory->id)],
            'description' => ['nullable', 'string', 'max:500'],
        ];
    }
}
