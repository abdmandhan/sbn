<?php

use Abdmandhan\Sbn\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'    => 'api/sbn',
], function () {
    Route::get('product', [ProductController::class, 'index']);
});
