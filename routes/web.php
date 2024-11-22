<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\API\CarRentalController;
use App\Http\Controllers\API\ListProductController;

Route::get('/', [ProductController::class, 'index'])->name('product')->middleware(['isAdmin', 'auth']);
Route::get('/list-product', [ListProductController::class, 'index'])->name('list-product');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
