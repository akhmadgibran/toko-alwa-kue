<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

// Route::get('/home', function () {
//     return view('home');
// })->name('home')->middleware('auth', 'verified');

// Route::view('/profile/edit', 'profile.edit')->middleware('auth', 'verified')->name('profile.edit');
// Route::view('/profile/password', 'profile.password')->middleware('auth', 'verified')->name('profile.password');

Route::middleware(['auth'])->group(function () {

    Route::get('/home', function () {
        return view('home');
    });
    Route::view('/profile/edit', 'profile.edit')->name('profile.edit');
    Route::view('/profile/password', 'profile.password')->name('profile.password');
});

// group route usertype admin
Route::middleware(['auth', 'admin'])->group(function () {

    Route::controller(ProductCategoryController::class)->group(function () {
        Route::get('/category', 'adminIndex')->name('admin.category.index');
        Route::get('/category/create', 'create')->name('admin.category.create');
        Route::post('/category', 'store')->name('admin.category.store');
        Route::get('/category/{id}/edit', 'edit')->name('admin.category.edit');
        Route::put('/category/{id}', 'update')->name('admin.category.update');
        Route::delete('/category/{id}', 'destroy')->name('admin.category.destroy');
    });

    Route::controller(ProductController::class)->group(function () {
        Route::get('/product', 'adminIndex')->name('admin.product.index');
        Route::get('/product/create', 'create')->name('admin.product.create');
        Route::post('/product', 'store')->name('admin.product.store');
        Route::get('/product/{id}/edit', 'edit')->name('admin.product.edit');
        // Route::put('/product/{id}', 'update')->name('admin.product.update');
        Route::put('/product/{id}', 'update')->name('admin.product.update');
        Route::delete('/product/{id}', 'destroy')->name('admin.product.destroy');
    });
});

Route::middleware(['auth', 'superadmin'])->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::get('/admin', 'index')->name('superadmin.admin.index');
        Route::get('/admin/create', 'create')->name('superadmin.admin.create');
        Route::post('/admin', 'store')->name('superadmin.admin.store');
        Route::get('/admin/{id}/edit', 'edit')->name('superadmin.admin.edit');
        Route::put('/admin/{id}', 'update')->name('superadmin.admin.update');
        Route::delete('/admin/{id}', 'destroy')->name('superadmin.admin.destroy');
    });
});

Route::put('/product/{id}', [ProductController::class, 'update'])->name('admin.product.update');

// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

// Route::get('/register', function () {
//     return view('auth.register');
// })->name('register');
