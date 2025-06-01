<?php

use App\Modules\Order\Http\Controllers\CheckoutController;
use Illuminate\Support\Facades\Route;

Route::get('order-lists', fn() => 'Hello world');
Route::middleware(['auth'])->group(function () {
    Route::post('checkout', CheckoutController::class)->name('checkout');
});
