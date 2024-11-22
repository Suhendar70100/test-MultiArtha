<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ListProductController;

Route::get('/', [ProductController::class, 'index'])->name('product')->middleware(['isAdmin', 'auth']);
Route::get('/list-product', [ListProductController::class, 'index'])->name('list-product');

require __DIR__.'/auth.php';
