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
use App\Http\Controllers\Backpanel\WebsiteSettingController;
use App\Http\Controllers\Backpanel\UserController;
use App\Http\Controllers\Frontpanel\UserCartController;
use App\Http\Controllers\Frontpanel\UserAuthController;
use App\Http\Controllers\Frontpanel\UserAccountController;
use App\Http\Controllers\Frontpanel\UserAddressController;


// USER / CUSTOMER
Route::get('/register', [UserAuthController::class, 'registerView'])->name('frontpanel.user.register');
Route::post('/register', [UserAuthController::class, 'register'])->name('frontpanel.user.register.process');
Route::get('/login', [UserAuthController::class, 'loginView'])->name('frontpanel.user.login');
Route::post('/login', [UserAuthController::class, 'login'])->name('frontpanel.user.login.process');
Route::get('/', [HomeController::class, 'index'])->name('frontpanel.home');
Route::get('/products/{a}', [HomeController::class, 'showDetailProduct'])->name('frontpanel.products.detail');

Route::post('/cart/add', [UserCartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/buy-now', [UserCartController::class, 'buyNow'])->name('cart.buyNow');
Route::middleware('auth')->group(function () {
    Route::get('/account', [UserAccountController::class, 'account'])->name('frontpanel.account');
    Route::get('/account/orders', [UserAccountController::class, 'orders'])->name('frontpanel.account.orders');
    Route::get('/account/favorites', [UserAccountController::class, 'favorites'])->name('frontpanel.account.favorites');
    Route::get('/account/addresses', [UserAccountController::class, 'addresses'])->name('frontpanel.account.addresses');

    // DEMOGRAPHIC
    Route::post('/account/addresses/store', [UserAddressController::class, 'store'])->name('frontpanel.account.addresses.store');
    Route::get('/get-regencies/{province_id}', [UserAddressController::class, 'getRegencies']);
    Route::get('/get-districts/{regency_id}', [UserAddressController::class, 'getDistricts']);
    Route::get('/get-villages/{district_id}', [UserAddressController::class, 'getVillages']);
    Route::put('/account/addresses/update/{id}', [UserAddressController::class, 'update'])->name('frontpanel.account.addresses.update');
    Route::delete('/account/addresses/destroy/{id}', [UserAddressController::class, 'destroy'])->name('frontpanel.account.addresses.destroy');


});


// SUPERADMIN / ADMIN

Route::get('/backpanel/login', [AuthController::class, 'login'])->name('login');

Route::post('/backpanel/login', [AuthController::class, 'loginProcess'])->name('login.process');
Route::post('/backpanel/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('backpanel')->middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('backpanel.dashboard.index');

    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('backpanel.categories.index');
        Route::post('/store', [CategoryController::class, 'store'])->name('backpanel.categories.store');
        Route::put('/update/{a}', [CategoryController::class, 'update'])->name('backpanel.categories.update');
        Route::delete('/destroy/{a}', [CategoryController::class, 'destroy'])->name('backpanel.categories.destroy');
    });

    Route::prefix('products')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('products.index');
        Route::get('/create', [ProductController::class, 'create'])->name('products.create');
        Route::post('/store', [ProductController::class, 'store'])->name('products.store');
        Route::get('/edit/{a}', [ProductController::class, 'edit'])->name('products.edit');
        Route::put('/update/{a}', [ProductController::class, 'update'])->name('products.update');
    });

    // Banner Routes
    Route::prefix('banners')->group(function () {
        Route::get('/', [BannerController::class, 'index'])->name('banners.index');
        Route::post('/create', [BannerController::class, 'create'])->name('banners.create');
        Route::post('/edit/{id}', [BannerController::class, 'edit'])->name('banners.edit');
        Route::post('/delete/{id}', [BannerController::class, 'delete'])->name('banners.delete');
    });

    Route::prefix('shipping-services')->group(function () {
        Route::get('/', [ShippingServiceController::class, 'index'])->name('shipping_services.index');
        Route::post('/', [ShippingServiceController::class, 'store'])->name('shipping_services.store');
        Route::put('/{id}', [ShippingServiceController::class, 'update'])->name('shipping_services.update');
        Route::delete('/{id}', [ShippingServiceController::class, 'destroy'])->name('shipping_services.delete');
    });

    Route::prefix('payments/payment-methods')->group(function () {
        Route::get('/', [PaymentMethodController::class, 'index'])->name('payment_methods.index');
        Route::post('/', [PaymentMethodController::class, 'store'])->name('payment_methods.store');
        Route::put('/{id}', [PaymentMethodController::class, 'update'])->name('payment_methods.update');
        Route::delete('/{id}', [PaymentMethodController::class, 'destroy'])->name('payment_methods.destroy');
    });

    Route::prefix('payments/payment-accounts')->group(function () {
        Route::get('/', [PaymentAccountController::class, 'index'])->name('payment_accounts.index');
        Route::post('/', [PaymentAccountController::class, 'store'])->name('payment_accounts.store');
        Route::put('/{id}', [PaymentAccountController::class, 'update'])->name('payment_accounts.update');
        Route::delete('/{id}', [PaymentAccountController::class, 'destroy'])->name('payment_accounts.destroy');
    });

    Route::prefix('website-setting')->group(function () {
        Route::get('/', [WebsiteSettingController::class, 'websiteSettings'])->name('backpanel.website.settings');
        Route::post('/', [WebsiteSettingController::class, 'saveWebsiteSettings'])->name('backpanel.website.settings.save');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('backpanel.users.index');
        Route::post('/', [UserController::class, 'store'])->name('backpanel.users.store');
        Route::put('/{user}', [UserController::class, 'update'])->name('backpanel.users.update');
        Route::delete('/{user}', [UserController::class, 'destroy'])->name('backpanel.users.destroy');
    });
});
