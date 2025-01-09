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
use App\Http\Controllers\Admin\TranslationManageController;
use App\Http\Controllers\Admin\ProductApplicationController;
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

    Route::get('login', [AdminController::class, 'showLoginForm'])->name('admin.login')->middleware('guest:admin');
    Route::post('login', [AdminController::class, 'login'])->name('handle-login');

    Route::middleware('auth:admin')->group(function () {
        Route::get('dashboard', function () {
            $dashboardController = new \App\Http\Controllers\Admin\DashboardController();
            return $dashboardController->index();
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
            Route::prefix('contact')->name('contact.')->group(function () {
                Route::get('/', [ContactController::class, 'index'])->name('index');
                Route::get('/create', [ContactController::class, 'create'])->name('create');
                Route::post('/', [ContactController::class, 'store'])->name('store');
                Route::get('/{id}/edit', [ContactController::class, 'edit'])->name('edit');
                Route::put('/{id}', [ContactController::class, 'update'])->name('update');
                Route::delete('/{id}', [ContactController::class, 'destroy'])->name('destroy');
                Route::post('/toggle-status/{id}', [ContactController::class, 'toggleStatus'])->name('toggle-status');
            });
            Route::prefix('contact-form')->name('contact-form.')->group(function () {
                Route::get('/', [ContactFormController::class, 'index'])->name('index');
                Route::get('/{contactForm}', [ContactFormController::class, 'show'])->name('show');
                Route::delete('/{contactForm}', [ContactFormController::class, 'destroy'])->name('destroy');
                Route::post('/{contactForm}/mark-as-read', [ContactFormController::class, 'markAsRead'])->name('mark-as-read');
                Route::post('/{contactForm}/mark-as-unread', [ContactFormController::class, 'markAsUnread'])->name('mark-as-unread');
                Route::delete('-bulk-delete', [ContactFormController::class, 'bulkDelete'])->name('bulk-delete');
            });
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
            Route::post('social/{social}/toggle-status', [App\Http\Controllers\Admin\SocialMediaController::class, 'toggleStatus'])
                ->name('social.toggle-status');
            Route::post('social/order', [App\Http\Controllers\Admin\SocialMediaController::class, 'updateOrder'])
                ->name('social.order');
            Route::resource('translation-manage', TranslationManageController::class);
            Route::get('translation-manage', [TranslationManageController::class, 'index'])->name('translation-manage.index');
            Route::get('translation-manage/create', [TranslationManageController::class, 'create'])->name('translation-manage.create');
            Route::post('translation-manage', [TranslationManageController::class, 'store'])->name('translation-manage.store');
            Route::get('translation-manage/{translation}/edit', [TranslationManageController::class, 'edit'])->name('translation-manage.edit');
            Route::put('translation-manage/{translation}', [TranslationManageController::class, 'update'])->name('translation-manage.update');
            Route::delete('translation-manage/{translation}', [TranslationManageController::class, 'destroy'])->name('translation-manage.destroy');
            Route::resource('product-applications', ProductApplicationController::class)
                ->only(['index', 'show', 'destroy']);
            Route::post('product-applications/{id}/toggle-status', [ProductApplicationController::class, 'toggleStatus'])
                ->name('product-applications.toggle-status');
        });
    });
});


