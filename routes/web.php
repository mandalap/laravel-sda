<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\ListCityController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('beranda.index');
});


Route::get('/', function () {
    return view('beranda.index')->name('beranda');
});

// Login
Route::get('/login', [RegisterController::class, 'login'])->name('login');
Route::post('/postlogin', [RegisterController::class, 'postlogin'])->name('postlogin');

// Daftar
Route::get('/daftar', [RegisterController::class, 'daftar'])->name('daftar');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Password
Route::get('/lupa-password', [RegisterController::class, 'lupapassword'])->name('lupapassword');
Route::post('/reset-password', [RegisterController::class, 'resetpassword'])->name('resetpassword');

// Logout
Route::get('/logout', [RegisterController::class, 'logout'])->name('logout');

/// Beranda
Route::get('/', [BerandaController::class, 'beranda'])->name('beranda');


/// List City
Route::get('/tanah-kota', [ListCityController::class, 'tanahkota'])->name('tanahkota');
Route::get('/tanah-kota/{slug}', [ListCityController::class, 'detailtanakota'])->name('detailtanakota');

/// Details
Route::get('/tanah-kavling/{slug}', [DetailsController::class, 'index'])->name('detailstanahkavling');
Route::get('/tanah-kavling/{slug}/cust-info', [DetailsController::class, 'custinfo'])->name('custinfo');
Route::get('/tanah-kavling/{slug}/checkout', [DetailsController::class, 'checkout'])->name('checkout');



