<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\CategoryPageController;
use App\Http\Controllers\CheckoutPageController;

Route::get('/', [HomePageController::class, 'homePage'])->name('home');
Route::get('/categories', [CategoryPageController::class, 'categoryPage'])->name('categories');
Route::get('/category/{category:slug}', [CategoryPageController::class, 'categoryDetails'])->name('category-details');
Route::get('/checkout', [CheckoutPageController::class, 'checkoutPage'])->name('checkout');
Route::get('/item/{id}', [HomePageController::class, 'itemDetails'])->name('item-details');
// Route::get('/item/{id}', [HomePageController::class, 'item'])->name('item');
// Route::get('/cart', [HomePageController::class, 'cart'])->name('cart');
// Route::get('/checkout', [HomePageController::class, 'checkout'])->name('checkout');
// Route::get('/order', [HomePageController::class, 'order'])->name('order');
// Route::get('/order/{id}', [HomePageController::class, 'orderDetail'])->name('orderDetail');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::apiResource('home', App\Http\Controllers\API\HomeController::class);

require __DIR__.'/auth.php';
