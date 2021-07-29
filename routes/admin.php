<?php

use App\Http\Controllers\Admin\SellerController;

Route::post('/sellers',[SellerController::class,'store']);

