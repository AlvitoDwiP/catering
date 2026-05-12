<?php

use App\Http\Controllers\Public\CartController;
use App\Http\Controllers\Public\CheckoutController;
use App\Http\Controllers\Public\HomeController;
use App\Http\Controllers\Public\InvoiceController;
use App\Http\Controllers\Public\MenuController;
use App\Http\Controllers\Public\OrderTrackingController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class)->name('public.home');
Route::get('/menu', [MenuController::class, 'index'])->name('public.menus.index');
Route::get('/menu/{menu:slug}', [MenuController::class, 'show'])->name('public.menus.show');

Route::get('/keranjang', [CartController::class, 'index'])->name('public.cart.index');
Route::post('/keranjang', [CartController::class, 'store'])->name('public.cart.store');
Route::patch('/keranjang/{menu}', [CartController::class, 'update'])->name('public.cart.update');
Route::delete('/keranjang/{menu}', [CartController::class, 'destroy'])->name('public.cart.destroy');

Route::get('/checkout', [CheckoutController::class, 'create'])->name('public.checkout.create');
Route::post('/checkout/review', [CheckoutController::class, 'review'])->name('public.checkout.review');
Route::post('/checkout/submit', [CheckoutController::class, 'store'])->name('public.checkout.store');

Route::get('/invoice/{order:invoice_number}', [InvoiceController::class, 'show'])->name('public.invoices.show');

Route::get('/cek-pesanan', [OrderTrackingController::class, 'create'])->name('public.orders.track.create');
Route::post('/cek-pesanan', [OrderTrackingController::class, 'store'])->name('public.orders.track.store');
