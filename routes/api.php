<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HeaderController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\ContactFormController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AboutController;
use App\Http\Controllers\Api\CertificateController;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\SocialMediaController;
use App\Http\Controllers\Api\TranslationController;

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
    
    // About route
    Route::get('/about', [AboutController::class, 'index']);
    
    // Certificate routes
    Route::get('/certificates', [CertificateController::class, 'index']);
    Route::get('/certificates/{id}', [CertificateController::class, 'show']);
    
    // Service routes
    Route::get('/services', [ServiceController::class, 'index']);
    Route::get('/services/{id}', [ServiceController::class, 'show']);
    
    // Customer routes
    Route::get('/customers', [CustomerController::class, 'index']);
    Route::get('/customers/{id}', [CustomerController::class, 'show']);
    
    // Project routes
    Route::get('/projects', [ProjectController::class, 'index']);
    Route::get('/projects/{id}', [ProjectController::class, 'show']);
    
    // Social Media routes
    Route::get('/social-media', [SocialMediaController::class, 'index']);
    Route::get('/social-media/{id}', [SocialMediaController::class, 'show']);
    
    // Translation routes
    Route::get('/translations', [TranslationController::class, 'index']);
    Route::post('/translations', [TranslationController::class, 'update']);
});






