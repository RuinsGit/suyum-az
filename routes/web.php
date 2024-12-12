<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubCategoryController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ServiceController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::post('login', [AdminController::class, 'login'])->name('handle-login');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', function () {
            return view('back.admin.dashboard');
        })->name('admin.dashboard');

        Route::get('profile', function () {
            return view('back.admin.profile');
        })->name('admin.profile');

        Route::post('logout', [AdminController::class, 'logout'])->name('admin.logout');

        Route::prefix('pages')->name('pages.')->group(function () {
            Route::get('header', [HeaderController::class, 'index'])->name('header.index');
            Route::get('header/create', [HeaderController::class, 'create'])->name('header.create');
            Route::post('header', [HeaderController::class, 'store'])->name('header.store');
            Route::get('header/{id}/edit', [HeaderController::class, 'edit'])->name('header.edit');
            Route::put('header/{id}', [HeaderController::class, 'update'])->name('header.update');
            Route::delete('header/{id}', [HeaderController::class, 'destroy'])->name('header.destroy');
            Route::resource('category', CategoryController::class)->except(['show']);
            Route::post('category/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('category.toggle-status');
            Route::resource('product', ProductController::class);
            Route::post('product/delete-image/{product}/{type}', [ProductController::class, 'deleteImage'])->name('product.delete-image');
            Route::patch('product/{id}/toggle-status', [ProductController::class, 'toggleStatus'])->name('product.toggle-status');
            Route::resource('subcategory', SubCategoryController::class)->except(['show']);
            Route::patch('subcategory/{id}/toggle-status', [SubCategoryController::class, 'toggleStatus'])->name('subcategory.toggle-status');
            Route::get('get-subcategories/{category}', [SubCategoryController::class, 'getSubCategories'])->name('subcategory.get-subcategories');
            Route::get('about', [AboutController::class, 'index'])->name('about.index');
            Route::put('about/update', [AboutController::class, 'update'])->name('about.update');
            Route::resource('service', ServiceController::class)->except(['show']);
            Route::post('service/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('service.toggle-status');
            Route::get('contact', [ContactController::class, 'index'])->name('contact.index');
            Route::put('contact/update', [ContactController::class, 'update'])->name('contact.update');
        });
    });
});
