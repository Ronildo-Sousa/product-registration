<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;



Route::post('/login', [AuthController::class, 'loginUser'])->name('auth.login');
Route::get('/', [ProductController::class, 'index'])->name('products.index');

Route::get('products/{slug}', [ProductController::class, 'show'])->name('products.show');
Route::get('/product/search', [ProductController::class, 'search'])->name('product.search');


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/register', [AuthController::class, 'registerUser'])->name('auth.register');
    Route::post('/logout/{user}', [AuthController::class, 'logoutUser'])->name('auth.logout');

    Route::apiResource('categories', CategoryController::class)->parameters(['categories' => 'slug']);

    Route::apiResource('products', ProductController::class)->parameters(['products' => 'slug'])->except(['show', 'index', 'search']);
});
