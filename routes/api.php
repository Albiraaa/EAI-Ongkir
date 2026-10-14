<?php

use App\Http\Controllers\Api\ShippingController;
use Illuminate\Support\Facades\Route;

Route::middleware('throttle:60,1')->group(function () {
    Route::get('/shipping/provinces', [ShippingController::class, 'provinces'])->name('api.shipping.provinces');
    Route::get('/shipping/cities/{provinceId}', [ShippingController::class, 'cities'])->name('api.shipping.cities');
    Route::get('/shipping/districts/{cityId}', [ShippingController::class, 'districts'])->name('api.shipping.districts');

    Route::post('/shipping/cost', [ShippingController::class, 'cost'])->name('api.shipping.cost');
    Route::post('/shipping/check', [ShippingController::class, 'check'])->name('api.shipping.check');
});
