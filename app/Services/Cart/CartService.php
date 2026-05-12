<?php

namespace App\Services\Cart;

use App\Models\Menu;
use Illuminate\Support\Collection;

class CartService
{
    private const SESSION_KEY = 'cart.items';

    public function all(): Collection
    {
        return collect(session(self::SESSION_KEY, []));
    }

    public function add(Menu $menu, int $quantity): void
    {
        $items = $this->all();
        $menuId = (string) $menu->id;
        $existing = $items->get($menuId);

        $newQuantity = ($existing['quantity'] ?? 0) + $quantity;

        $items->put($menuId, $this->makeItem($menu, $newQuantity));

        session([self::SESSION_KEY => $items->all()]);
    }

    public function update(Menu $menu, int $quantity): void
    {
        $items = $this->all();
        $menuId = (string) $menu->id;

        if (! $items->has($menuId)) {
            return;
        }

        $items->put($menuId, $this->makeItem($menu, $quantity));

        session([self::SESSION_KEY => $items->all()]);
    }

    public function remove(Menu $menu): void
    {
        $items = $this->all();
        $items->forget((string) $menu->id);
        session([self::SESSION_KEY => $items->all()]);
    }

    public function clear(): void
    {
        session()->forget(self::SESSION_KEY);
    }

    public function count(): int
    {
        return $this->all()->count();
    }

    public function totalQuantity(): int
    {
        return (int) $this->all()->sum('quantity');
    }

    public function totalAmount(): float
    {
        return (float) $this->all()->sum('subtotal');
    }

    public function isEmpty(): bool
    {
        return $this->all()->isEmpty();
    }

    public function has(Menu $menu): bool
    {
        return $this->all()->has((string) $menu->id);
    }

    private function makeItem(Menu $menu, int $quantity): array
    {
        $price = (float) $menu->price;

        return [
            'menu_id' => $menu->id,
            'name' => $menu->name,
            'price' => $price,
            'unit' => $menu->unit,
            'image_url' => $menu->image_url,
            'minimum_order' => $menu->minimum_order,
            'quantity' => $quantity,
            'subtotal' => $price * $quantity,
        ];
    }
}
