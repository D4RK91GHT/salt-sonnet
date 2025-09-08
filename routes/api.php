<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\HomeController;
use App\Http\Controllers\API\ItemController;
use App\Http\Controllers\Api\CartController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// routes/api.php is already mounted at /api by the RouteServiceProvider
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/home', [HomeController::class, 'index']);
Route::apiResource('items', ItemController::class);

// Cart JSON routes
Route::get('/cart/items', [CartController::class, 'index']);
Route::post('/cart/items', [CartController::class, 'store']);
Route::delete('/cart/items/{id}', [CartController::class, 'destroy']);

// You can add more API routes here as needed
