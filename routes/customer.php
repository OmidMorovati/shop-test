<?php


use App\Http\Controllers\Customer\ProductController;

Route::get('/products', [ProductController::class, 'index']);
