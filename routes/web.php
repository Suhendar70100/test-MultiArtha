<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\ListProductController;

// tugas 2
Route::get('/', [ProductController::class, 'index'])->name('product')->middleware(['isAdmin', 'auth']);

// tugas 5
Route::get('/list-product', [ListProductController::class, 'index'])->name('list-product');

require __DIR__.'/auth.php';
