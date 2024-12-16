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
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\ContactFormController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\TranslationController;
use App\Http\Controllers\Admin\SocialMediaController;
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

        Route::prefix('pages')->name('pages.')->middleware(['auth', 'verified'])->group(function () {
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
            Route::get('contact-form', [ContactFormController::class, 'index'])->name('contact-form.index');
            Route::get('contact-form/{contactForm}', [ContactFormController::class, 'show'])->name('contact-form.show');
            Route::delete('contact-form/{contactForm}', [ContactFormController::class, 'destroy'])->name('contact-form.destroy');
            Route::post('contact-form/{contactForm}/mark-as-read', [ContactFormController::class, 'markAsRead'])->name('contact-form.mark-as-read');
            Route::post('contact-form/{contactForm}/mark-as-unread', [ContactFormController::class, 'markAsUnread'])->name('contact-form.mark-as-unread');
            Route::delete('contact-form-bulk-delete', [ContactFormController::class, 'bulkDelete'])->name('contact-form.bulk-delete');
            Route::resource('certificate', CertificateController::class);
            Route::post('certificate/{certificate}/toggle-status', [CertificateController::class, 'toggleStatus'])->name('certificate.toggle-status');
            Route::resource('customer', CustomerController::class);
            Route::post('customer/{customer}/toggle-status', [CustomerController::class, 'toggleStatus'])->name('customer.toggle-status');
            Route::resource('project', ProjectController::class);
            Route::post('project/{project}/toggle-status', [ProjectController::class, 'toggleStatus'])->name('project.toggle-status');
            Route::delete('/admin/product/{id}', [ProductController::class, 'destroy'])->name('pages.product.destroy');
            Route::get('translations', [TranslationController::class, 'index'])->name('translations.index');
            Route::post('translations/update', [TranslationController::class, 'update'])->name('translations.update');
            Route::resource('social', App\Http\Controllers\Admin\SocialMediaController::class);
            Route::post('social/order', [App\Http\Controllers\Admin\SocialMediaController::class, 'updateOrder'])
                ->name('social.order');
        });
    });
});
