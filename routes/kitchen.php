<?php

use App\Http\Controllers\Kitchen\DashboardController;
use App\Http\Controllers\Kitchen\IngredientRecapController;
use App\Http\Controllers\Kitchen\ProductionOrderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'kitchen'])
    ->prefix('kitchen')
    ->name('kitchen.')
    ->group(function (): void {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');
        Route::get('/production-orders', [ProductionOrderController::class, 'index'])->name('production-orders.index');
        Route::get('/production-orders/{order}', [ProductionOrderController::class, 'show'])->name('production-orders.show');
        Route::get('/ingredient-recaps', [IngredientRecapController::class, 'index'])->name('ingredient-recaps.index');
    });
