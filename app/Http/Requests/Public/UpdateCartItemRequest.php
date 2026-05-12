<?php

namespace App\Http\Requests\Public;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class UpdateCartItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $menu = $this->route('menu');

            if (! $menu instanceof Menu) {
                return;
            }

            if ($this->integer('quantity') < $menu->minimum_order) {
                $validator->errors()->add(
                    'quantity',
                    "Minimal pemesanan untuk menu ini adalah {$menu->minimum_order} {$menu->unit}."
                );
            }
        });
    }

    public function attributes(): array
    {
        return [
            'quantity' => 'jumlah',
        ];
    }
}
