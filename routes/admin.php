<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\MenuCategoryController;
use App\Http\Controllers\Admin\GSTSlabController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\ItemVariationTypeController;

Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Login Routes
    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);
    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

    // Protected admin routes
    Route::middleware(['auth:admin'])->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
        // Add other admin routes here
    });
    Route::get('item-category', [MenuCategoryController::class, 'index'])->name('item-category');
    Route::post('item-category', [MenuCategoryController::class, 'store'])->name('item-category.store');
    
    Route::get('item-variation-types', [ItemVariationTypeController::class, 'index'])->name('item-variation-types');
    Route::post('item-variation-types', [ItemVariationTypeController::class, 'store'])->name('item-variation-types.store');
    Route::put('item-variation-types/{itemVariationType}', [ItemVariationTypeController::class, 'update'])->name('item-variation-types.update');
    Route::delete('item-variation-types/{itemVariationType}', [ItemVariationTypeController::class, 'destroy'])->name('item-variation-types.destroy');
    
    Route::get('gst-slabs', [GSTSlabController::class, 'index'])->name('gst-slabs');
    Route::post('gst-slabs', [GSTSlabController::class, 'store'])->name('gst-slabs.store');

    Route::get('menu-items', [MenuItemController::class, 'index'])->name('menu-items');
    Route::post('menu-items', [MenuItemController::class, 'store'])->name('menu-items.store');
    Route::get('menu-items/{menuItem}', [MenuItemController::class, 'show'])->name('menu-items.single');
    Route::put('menu-items/{menuItem}', [MenuItemController::class, 'update'])->name('menu-items.update');
    Route::delete('menu-items/{menuItem}', [MenuItemController::class, 'destroy'])->name('menu-items.destroy');
    Route::delete('menu-items/images/{image}', [MenuItemController::class, 'destroyImage'])->name('menu-items.destroy-image');
});
