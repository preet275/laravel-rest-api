
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;

// Public route: Get all products
Route::get('/products', [ProductController::class, 'index']);

// Register API route
Route::post('/register', [AuthController::class, 'register']);

// Login API route
Route::post('/login', [AuthController::class, 'login']);

// Protected routes: Require a valid Sanctum token
Route::middleware('auth:sanctum')->group(function () {


    // Get a single product by ID
    Route::get('/products/{id}', [ProductController::class, 'show']);

    // Create a new product
    Route::post('/products', [ProductController::class, 'store']);

    // Update a product by ID
    Route::put('/products/{id}', [ProductController::class, 'update']);

    // Delete a product by ID
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);

});
