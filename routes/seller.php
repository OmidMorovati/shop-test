<?php

use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\StoreController;

Route::put('/store', [StoreController::class, 'update']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/products', [ProductController::class, 'index']);
