<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductControllers;
use App\Http\Controllers\SuperadminDashboard;
use App\Http\Controllers\ShopStatusController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductPromotionController;
use App\Http\Controllers\SuperadminDashboardController;

Route::controller(PublicController::class)->group(function () {
    Route::get('/', 'home')->name('home');
    Route::get('/home', 'home')->name('home');
    Route::get('product/category', [ProductCategoryController::class, 'index'])->name('product.category');
    Route::controller(ProductController::class)->group(function () {
        Route::get('product/category/{id}', 'index')->name('product.index');
        Route::get('product/{id}', 'show')->name('product.show');
    });

    Route::get('/about', function () {
        return view('about-us');
    })->name('about');
});



Route::get('/footerbuild', function () {
    return view('layouts.footer.footer-guest-costumer');
});

Route::get('cartBuild', function () {
    return view('costumer.cart.index');
});


Route::middleware(['auth'])->group(function () {

    Route::view('/profile/edit', 'profile.edit')->name('profile.edit');
    Route::view('/profile/password', 'profile.password')->name('profile.password');
});

Route::middleware(['auth', 'costumer', 'verified'])->group(function () {

    Route::get('/welcome', function () { // Or use a dedicated controller
        return view('costumer.dashboard'); // Create this view: resources/views/costumer/dashboard.blade.php
    })->name('costumer.dashboard');

    // Route group for cart
    Route::controller(CartController::class)->group(function () {
        Route::get('/cart', 'index')->name('costumer.cart.index');
        Route::post('/cart/store', 'store')->name('costumer.cart.store');
        Route::patch('/cart/{id}/quantity', 'updateQuantity')->name('costumer.cart.update');
        Route::delete('/cart/{id}', 'destroy')->name('costumer.cart.destroy');
    });

    Route::controller(CheckoutController::class)->group(function () {
        Route::get('/checkout', 'index')->name('costumer.checkout.index');
        Route::post('/checkout', 'store')->name('costumer.checkout.store');
        Route::post('/checkout/success/{custom_order_id}', 'success')->name('costumer.checkout.success');
        Route::post('/checkout/fail/{custom_order_id}', 'fail')->name('costumer.checkout.fail');
        Route::post('/checkout/pending/{custom_order_id}', 'pending')->name('costumer.checkout.pending');
        Route::post('/checkout/cancel/{custom_order_id}', 'cancel')->name('costumer.checkout.cancel');
        Route::get('/checkout/pending/{custom_order_id}/payment', 'pendingPayment')->name('checkout.pending.payment');
    });


    Route::get('order', [OrderController::class, 'indexCostumer'])->name('costumer.order.index');

    Route::post('order', [OrderController::class, 'costumerOrderFiltered'])->name('costumer.order.filtered');

    Route::get('order/{custom_order_id}', [OrderController::class, 'costumerShowOrder'])->name('costumer.order.show');
});

// group route usertype admin
Route::middleware(['auth', 'admin', 'verified'])->group(function () {

    // Route::get('/admin/dashboard', function () {
    //     return view('admin.dashboard');
    // })->name('admin.dashboard');

    Route::controller(AdminDashboardController::class)->group(function () {
        Route::get('admin/dashboard', 'index')->name('admin.dashboard');
    });

    Route::controller(ProductCategoryController::class)->group(function () {
        Route::get('admin/category', 'adminIndex')->name('admin.category.index');
        Route::get('admin/category/create', 'create')->name('admin.category.create');
        Route::post('admin/category', 'store')->name('admin.category.store');
        Route::get('admin/category/{id}/edit', 'edit')->name('admin.category.edit');
        Route::put('admin/category/{id}', 'update')->name('admin.category.update');
        Route::delete('admin/category/{id}', 'destroy')->name('admin.category.destroy');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('admin/product', 'adminIndex')->name('admin.product.index');
        Route::get('admin/product/create', 'create')->name('admin.product.create');
        Route::post('admin/product', 'store')->name('admin.product.store');
        Route::get('admin/product/{id}/edit', 'edit')->name('admin.product.edit');
        // Route::put('/product/{id}', 'update')->name('admin.product.update');
        Route::put('admin/product/{id}', 'update')->name('admin.product.update');
        Route::delete('admin/product/{id}', 'destroy')->name('admin.product.destroy');
    });

    Route::controller(ShopStatusController::class)->group(function () {
        Route::get('admin/shopstatus', 'adminIndex')->name('admin.shopstatus.index');
        // Route::get('/shopstatus/edit', 'edit')->name('admin.shopstatus.edit');
        Route::put('admin/shopstatus', 'update')->name('admin.shopstatus.update');
    });


    Route::controller(ProductPromotionController::class)->group(function () {
        Route::get('admin/productpromotion', 'index')->name('admin.productpromotion.index');
        Route::patch('admin/productpromotion/{id}', 'update')->name('admin.productpromotion.update');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('/admin/order', 'indexAdmin')->name('admin.order.index');
        Route::post('/admin/order', 'adminOrderFiltered')->name('admin.order.filtered');
        Route::get('/admin/order/{custom_order_id}', 'adminShowOrder')->name('admin.order.show');
        Route::put('/admin/order/{custom_order_id}', 'adminUpdateOrder')->name('admin.order.update');
    });
});

Route::middleware(['auth', 'superadmin', 'verified'])->group(function () {


    Route::controller(SuperadminDashboardController::class)->group(function () {
        Route::get('/superadmin/dashboard', 'index')->name('superadmin.dashboard');
    });

    Route::controller(AdminController::class)->group(function () {
        Route::get('superadmin/admin', 'index')->name('superadmin.admin.index');
        Route::get('superadmin/admin/create', 'create')->name('superadmin.admin.create');
        Route::post('superadmin/admin', 'store')->name('superadmin.admin.store');
        Route::get('superadmin/admin/{id}/edit', 'edit')->name('superadmin.admin.edit');
        Route::put('superadmin/admin/{id}', 'update')->name('superadmin.admin.update');
        Route::delete('superadmin/admin/{id}', 'destroy')->name('superadmin.admin.destroy');
    });

    Route::controller(ProductCategoryController::class)->group(function () {
        Route::get('/superadmin/category', 'adminIndex')->name('superadmin.category.index');
        Route::get('/superadmin/category/create', 'create')->name('superadmin.category.create');
        Route::post('/superadmin/category', 'store')->name('superadmin.category.store');
        Route::get('/superadmin/category/{id}/edit', 'edit')->name('superadmin.category.edit');
        Route::put('/superadmin/category/{id}', 'update')->name('superadmin.category.update');
        Route::delete('/superadmin/category/{id}', 'destroy')->name('superadmin.category.destroy');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/superadmin/product', 'adminIndex')->name('superadmin.product.index');
        Route::get('/superadmin/product/create', 'create')->name('superadmin.product.create');
        Route::post('/superadmin/product', 'store')->name('superadmin.product.store');
        Route::get('/superadmin/product/{id}/edit', 'edit')->name('superadmin.product.edit');
        // Route::put('/product/{id}', 'update')->name('admin.product.update');
        Route::put('/superadmin/product/{id}', 'update')->name('superadmin.product.update');
        Route::delete('/superadmin/product/{id}', 'destroy')->name('superadmin.product.destroy');
    });

    Route::controller(ShopStatusController::class)->group(function () {
        Route::get('/superadmin/shopstatus', 'adminIndex')->name('superadmin.shopstatus.index');
        // Route::get('/superadmin/shopstatus/edit', 'edit')->name('superadmin.shopstatus.edit');
        Route::put('/superadmin/shopstatus', 'update')->name('superadmin.shopstatus.update');
    });


    Route::controller(ProductPromotionController::class)->group(function () {
        Route::get('/superadmin/productpromotion', 'index')->name('superadmin.productpromotion.index');
        Route::patch('/superadmin/productpromotion/{id}', 'update')->name('superadmin.productpromotion.update');
    });

    Route::controller(OrderController::class)->group(function () {
        Route::get('/superadmin/order', 'indexAdmin')->name('superadmin.order.index');
        Route::post('/superadmin/order', 'adminOrderFiltered')->name('superadmin.order.filtered');
        Route::get('/superadmin/order/{custom_order_id}', 'adminShowOrder')->name('superadmin.order.show');
        Route::put('/superadmin/order/{custom_order_id}', 'adminUpdateOrder')->name('superadmin.order.update');
    });

    Route::controller(SiteSettingController::class)->group(function () {
        Route::get('/superadmin/site-setting', 'index')->name('superadmin.site-setting.index');
        Route::put('/superadmin/site-setting', 'update')->name('superadmin.site-setting.update');
    });
});
