<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Product;
use App\Models\Service;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Register API routes for your application. These routes are loaded by the
| RouteServiceProvider and are assigned to the "api" middleware group.
|
*/

use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

// --- Product & Service API Endpoints ---
// Route::middleware('auth:api')->group(function () {
    Route::apiResource('products', ProductController::class)->names('api.products');
    Route::apiResource('categories', \App\Http\Controllers\Api\CategoryController::class)->names('api.categories');
// });

// Services also? The user asked for "CRUD APIs exposed". Products and Categories are explicitly mentioned in task list.
// I'll keep it simple: Products and Categories.
