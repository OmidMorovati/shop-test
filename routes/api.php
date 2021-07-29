<?php

use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/me', [AuthController::class, 'me']);
    Route::prefix('/admin')->group(function () {
        Route::post('/sellers',[SellerController::class,'store']);
    });
    Route::prefix('/seller')->group(function () {
        Route::put('/store',[StoreController::class,'update']);
        Route::post('/products',[ProductController::class,'store']);
    });
});
