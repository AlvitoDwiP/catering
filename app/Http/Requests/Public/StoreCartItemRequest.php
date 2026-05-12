<?php

namespace App\Http\Requests\Public;

use App\Models\Menu;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class StoreCartItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'menu_id' => ['required', 'exists:menus,id'],
            'quantity' => ['required', 'integer', 'min:1'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator) {
            $menuId = $this->integer('menu_id');
            $menu = Menu::query()->find($menuId);

            if (! $menu) {
                return;
            }

            if (! $menu->is_available) {
                $validator->errors()->add('menu_id', 'Menu ini saat ini belum tersedia.');
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
            'menu_id' => 'menu',
            'quantity' => 'jumlah',
        ];
    }
}
