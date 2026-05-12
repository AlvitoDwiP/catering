<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\IngredientController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\MenuController;
use App\Http\Controllers\Admin\MenuIngredientController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function (): void {
        Route::get('/dashboard', DashboardController::class)->name('dashboard');

        Route::resource('menu-categories', MenuCategoryController::class);
        Route::resource('menus', MenuController::class);
        Route::resource('ingredients', IngredientController::class)->except('show');

        Route::get('/menus/{menu}/ingredients', [MenuIngredientController::class, 'index'])->name('menus.ingredients.index');
        Route::get('/menus/{menu}/ingredients/create', [MenuIngredientController::class, 'create'])->name('menus.ingredients.create');
        Route::post('/menus/{menu}/ingredients', [MenuIngredientController::class, 'store'])->name('menus.ingredients.store');
        Route::get('/menus/{menu}/ingredients/{menuIngredient}/edit', [MenuIngredientController::class, 'edit'])->name('menus.ingredients.edit');
        Route::match(['put', 'patch'], '/menus/{menu}/ingredients/{menuIngredient}', [MenuIngredientController::class, 'update'])->name('menus.ingredients.update');
        Route::delete('/menus/{menu}/ingredients/{menuIngredient}', [MenuIngredientController::class, 'destroy'])->name('menus.ingredients.destroy');

        Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.update-status');

        Route::get('/reports/orders', [ReportController::class, 'orders'])->name('reports.orders');

        Route::get('/invoices/{order}', [InvoiceController::class, 'show'])->name('invoices.show');
    });
