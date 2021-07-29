<?php


use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\ProductController;

Route::get('/products', [ProductController::class, 'index']);
Route::post('/order', [OrderController::class, 'store']);
