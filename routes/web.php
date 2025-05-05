<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BestSellerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductControllers;
use App\Http\Controllers\ShopStatusController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('homeV2');
});
Route::get('/homebuild', function () {
    return view('homeV2');
});

Route::get('/footerbuild', function () {
    return view('layouts.footer.footer-guest-costumer');
});

Route::get('cartBuild', function () {
    return view('costumer.cart.index');
});

Route::get('product/category', [ProductCategoryController::class, 'index'])->name('product.category');
// Route::get('/product/category/{id}', [ProductControllers::class, 'index'])->name('user.product.index');
Route::controller(ProductController::class)->group(function () {
    Route::get('product/category/{id}', 'index')->name('product.index');
    Route::get('product/{id}', 'show')->name('product.show');
});

Route::get('/home', function () {
    return view('homeV2');
})->name('home');

// Route::get('/home', function () {
//     return view('home');
// })->name('home')->middleware('auth', 'verified');

// Route::view('/profile/edit', 'profile.edit')->middleware('auth', 'verified')->name('profile.edit');
// Route::view('/profile/password', 'profile.password')->middleware('auth', 'verified')->name('profile.password');

Route::middleware(['auth'])->group(function () {

    Route::view('/profile/edit', 'profile.edit')->name('profile.edit');
    Route::view('/profile/password', 'profile.password')->name('profile.password');
});

Route::middleware(['auth', 'costumer'])->group(function () {

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
    });
});

// group route usertype admin
Route::middleware(['auth', 'admin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

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

    Route::controller(BestSellerController::class)->group(function () {
        Route::get('admin/bestseller', 'index')->name('admin.bestseller.index');
        // Route::get('/bestseller/create', 'create')->name('admin.bestseller.create');
        // Route::post('/bestseller', 'store')->name('admin.bestseller.store');
        // Route::get('/bestseller/{id}/edit', 'edit')->name('admin.bestseller.edit');
        Route::put('admin/bestseller', 'update')->name('admin.bestseller.update');
        // Route::delete('/bestseller/{id}', 'destroy')->name('admin.bestseller.destroy');
    });
});

Route::middleware(['auth', 'superadmin'])->group(function () {

    Route::get('/superadmin/dashboard', function () {
        return view('superadmin.dashboard');
    })->name('superadmin.dashboard');

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

    Route::controller(BestSellerController::class)->group(function () {
        Route::get('/superadmin/bestseller', 'index')->name('superadmin.bestseller.index');
        // Route::get('/bestseller/create', 'create')->name('admin.bestseller.create');
        // Route::post('/bestseller', 'store')->name('admin.bestseller.store');
        // Route::get('/bestseller/{id}/edit', 'edit')->name('admin.bestseller.edit');
        Route::put('/superadmin/bestseller', 'update')->name('superadmin.bestseller.update');
        // Route::delete('/bestseller/{id}', 'destroy')->name('admin.bestseller.destroy');
    });
});
// Route::put('/product/{id}', [ProductController::class, 'update'])->name('admin.product.update');

// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

// Route::get('/register', function () {
//     return view('auth.register');
// })->name('register');
