<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;

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
            Route::resource('product', ProductController::class);
        });
    });
});
