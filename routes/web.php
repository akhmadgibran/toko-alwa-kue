<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('layouts.app');
});

Route::get('/home', function () {
    return view('home');
})->name('home')->middleware('auth', 'verified');

Route::view('/profile/edit', 'profile.edit')->middleware('auth', 'verified')->name('profile.edit');
Route::view('/profile/password', 'profile.password')->middleware('auth', 'verified')->name('profile.password');



// Route::get('/login', function () {
//     return view('auth.login');
// })->name('login');

// Route::get('/register', function () {
//     return view('auth.register');
// })->name('register');
