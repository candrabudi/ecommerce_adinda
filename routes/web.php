<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backpanel\AuthController;
use App\Http\Controllers\Backpanel\DashboardController;
use App\Http\Controllers\Backpanel\CategoryController;
use App\Http\Controllers\Backpanel\ProductController;
use App\Http\Controllers\Backpanel\BannerController;
use App\Http\Controllers\Backpanel\ShippingServiceController;
use App\Http\Controllers\Frontpanel\HomeController;
use App\Http\Controllers\Backpanel\PaymentMethodController;
use App\Http\Controllers\Backpanel\PaymentAccountController;
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

Route::get('/', [HomeController::class, 'index'])->name('frontpanel.home');

Route::get('/backpanel/dashboard', [DashboardController::class, 'index'])->name('backpanel.dashboard.index');
Route::get('/backpanel/categories', [CategoryController::class, 'index'])->name('backpanel.categories.index');
Route::post('/backpanel/categories/store', [CategoryController::class, 'store'])->name('backpanel.categories.store');
Route::put('/backpanel/categories/update/{a}', [CategoryController::class, 'update'])->name('backpanel.categories.update');
Route::delete('/backpanel/categories/destroy/{a}', [CategoryController::class, 'destroy'])->name('backpanel.categories.destroy');

Route::get('/backpanel/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/backpanel/products/create', [ProductController::class, 'create'])->name('products.create');
Route::post('/backpanel/products/store', [ProductController::class, 'store'])->name('products.store');
Route::get('/backpanel/products/edit/{a}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('/backpanel/products/update/{a}', [ProductController::class, 'update'])->name('products.update');

Route::get('backpanel/banners', [BannerController::class, 'index'])->name('banners.index');
Route::post('backpanel/banners/create', [BannerController::class, 'create'])->name('banners.create');
Route::post('backpanel/banners/edit/{id}', [BannerController::class, 'edit'])->name('banners.edit');
Route::post('backpanel/banners/delete/{id}', [BannerController::class, 'delete'])->name('banners.delete');

Route::get('/backpanel/shipping-services', [ShippingServiceController::class, 'index'])->name('shipping_services.index');
Route::post('/backpanel/shipping-services', [ShippingServiceController::class, 'store'])->name('shipping_services.store');
Route::put('/backpanel/shipping-services/{id}', [ShippingServiceController::class, 'update'])->name('shipping_services.update');
Route::delete('/backpanel/shipping-services/{id}', [ShippingServiceController::class, 'destroy'])->name('shipping_services.delete');

Route::get('/backpanel/payments/payment-methods', [PaymentMethodController::class, 'index'])->name('payment_methods.index');
Route::post('/backpanel/payments/payment-methods', [PaymentMethodController::class, 'store'])->name('payment_methods.store');
Route::put('/backpanel/payments/payment-methods/{id}', [PaymentMethodController::class, 'update'])->name('payment_methods.update');
Route::delete('/backpanel/payments/payment-methods/{id}', [PaymentMethodController::class, 'destroy'])->name('payment_methods.destroy');

Route::get('/backpanel/payments/payment-accounts', [PaymentAccountController::class, 'index'])->name('payment_accounts.index');
Route::post('/backpanel/payments/payment-accounts', [PaymentAccountController::class, 'store'])->name('payment_accounts.store');
Route::put('/backpanel/payments/payment-accounts/{id}', [PaymentAccountController::class, 'update'])->name('payment_accounts.update');
Route::delete('/backpanel/payments/payment-accounts/{id}', [PaymentAccountController::class, 'destroy'])->name('payment_accounts.destroy');

Route::get('/login', [AuthController::class, 'login'])->name('backpanel.login');