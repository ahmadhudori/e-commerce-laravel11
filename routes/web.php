<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/product/create', [ProductController::class, 'create_product'])->name('create_product');
Route::post('/product/create', [ProductController::class, 'store_product'])->name('store_product');
Route::get('/product', [ProductController::class, 'index_product'])->name('index_product');
Route::get('/product/{product}', [ProductController::class, 'show_product'])->name('show_product');
Route::get('/product/{product}/edit', [ProductController::class, 'edit_product'])->name('edit_product');
Route::patch('/product/{product}', [ProductController::class, 'update_product'])->name('update_product');
Route::delete('/product/{product}', [ProductController::class, 'delete_product'])->name('delete_product');

Route::post('/cart/{product}', [CartController::class, 'add_to_cart'])->name('add_to_cart');