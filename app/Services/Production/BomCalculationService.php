<?php

namespace App\Services\Production;

use App\Models\Order;
use Illuminate\Support\Collection;

class BomCalculationService
{
    public function calculateForOrder(Order $order): Collection
    {
        $order->loadMissing(['items.menu.menuIngredients.ingredient']);

        $rows = collect();

        foreach ($order->items as $item) {
            if (! $item->menu) {
                continue;
            }

            foreach ($item->menu->menuIngredients as $menuIngredient) {
                if (! $menuIngredient->ingredient) {
                    continue;
                }

                $quantityPerPortion = (float) $menuIngredient->quantity_per_portion;
                $orderQuantity = (float) $item->quantity;
                $totalQuantity = $quantityPerPortion * $orderQuantity;

                $rows->push([
                    'ingredient_id' => $menuIngredient->ingredient->id,
                    'ingredient_name' => $menuIngredient->ingredient->name,
                    'ingredient_unit' => $menuIngredient->unit,
                    'total_quantity' => $totalQuantity,
                    'detail' => [
                        'menu_name' => $item->menu_name,
                        'order_quantity' => (int) $item->quantity,
                        'quantity_per_portion' => $quantityPerPortion,
                        'total_quantity' => $totalQuantity,
                        'unit' => $menuIngredient->unit,
                    ],
                ]);
            }
        }

        return $rows
            ->groupBy('ingredient_id')
            ->map(function (Collection $group) {
                $first = $group->first();

                return [
                    'ingredient_id' => $first['ingredient_id'],
                    'ingredient_name' => $first['ingredient_name'],
                    'ingredient_unit' => $first['ingredient_unit'],
                    'total_quantity' => round($group->sum('total_quantity'), 2),
                    'details' => $group->pluck('detail')->values(),
                ];
            })
            ->values();
    }

    public function calculateForOrders(Collection $orders): Collection
    {
        $rows = collect();

        foreach ($orders as $order) {
            $needs = $this->calculateForOrder($order);

            foreach ($needs as $need) {
                $rows->push([
                    'ingredient_id' => $need['ingredient_id'],
                    'ingredient_name' => $need['ingredient_name'],
                    'ingredient_unit' => $need['ingredient_unit'],
                    'total_quantity' => (float) $need['total_quantity'],
                ]);
            }
        }

        return $rows
            ->groupBy('ingredient_id')
            ->map(function (Collection $group) {
                $first = $group->first();

                return [
                    'ingredient_id' => $first['ingredient_id'],
                    'ingredient_name' => $first['ingredient_name'],
                    'ingredient_unit' => $first['ingredient_unit'],
                    'total_quantity' => round($group->sum('total_quantity'), 2),
                ];
            })
            ->values();
    }

    public function hasMissingBom(Order $order): bool
    {
        return $this->missingBomMenus($order)->isNotEmpty();
    }

    public function missingBomMenus(Order $order): Collection
    {
        $order->loadMissing(['items.menu.menuIngredients']);

        return $order->items
            ->filter(function ($item) {
                if (! $item->menu) {
                    return true;
                }

                return $item->menu->menuIngredients->isEmpty();
            })
            ->map(fn ($item) => [
                'menu_id' => $item->menu_id,
                'menu_name' => $item->menu_name,
            ])
            ->unique('menu_name')
            ->values();
    }
}
