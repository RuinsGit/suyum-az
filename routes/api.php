<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HeaderController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ContactFormController;
use App\Http\Controllers\Api\ProductController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user(); 
});

Route::prefix('/')->group(function () {
    Route::get('/header', [HeaderController::class, 'index']);
    Route::get('/contact', [ContactController::class, 'index']);
    Route::post('/contact-form', [ContactFormController::class, 'store']);
    
    // Product routes
    Route::get('/products', [ProductController::class, 'index']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
});






