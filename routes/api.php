<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/{product:id}', [ProductController::class, 'show']);
Route::post('/products', [ProductController::class, 'store']);
Route::put('/products/{product:id}', [ProductController::class, 'update']);
Route::delete('/products/{product:id}', [ProductController::class, 'destroy']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/{category:id}', [CategoryController::class, 'show']);
Route::post('/categories', [CategoryController::class, 'store']);
Route::put('/categories/{category:id}', [CategoryController::class, 'update']);
Route::delete('/categories/{category:id}', [CategoryController::class, 'destroy']);
