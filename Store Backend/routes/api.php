<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Auth\RegisterController;


Route::post('register', [AuthController::class, 'register']);

Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('addtocart/{id}', [CartController::class, 'store']);

Route::get('products', [ProductsController::class, 'indexapi']);
// Route::get('products',[ProductsController::class,'index2']);
Route::get('cart-index', [CartController::class, 'show']);

Route::post('admin/register', [RegisterController::class, 'register']);
Route::post('admin/login', [RegisterController::class, 'login']);
