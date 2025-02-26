<?php

use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CekBookingController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\ListCityController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\ProfilController;
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
Route::get('/jual/{slug}', [ListCityController::class, 'kategori'])->name('kategori');
Route::get('/{kategori}/{cities}', [ListCityController::class, 'detailkategori'])->name('detailkategori');
Route::get('/lihat-semua', [ListCityController::class, 'lihat'])->name('lihatsemua');

Route::get('/lihat-kota', [ListCityController::class, 'lihatkota'])->name('lihatkota');
Route::get('/properti', [ListCityController::class, 'properti'])->name('properti');

/// Details
Route::get('/{jenis}/{kategori}/{project}', [DetailsController::class, 'index'])->name('detailproject');
Route::get('/{jenis}/{kategori}/{project}/info', [DetailsController::class, 'custinfo'])->name('custinfo');

// checkcout
Route::post('/checkout/{project}', [DetailsController::class, 'checkout'])->name('checkout');
/// Lihat Semua


/// Check Booking
Route::get('/check-booking', [CekBookingController::class, 'index'])->name('checkbooking');

/// Pencarian
Route::get('/pencarian', [PencarianController::class, 'index'])->name('pencarian');


// Profil
Route::get('/profil', [ProfilController::class, 'index'])->name('profil');
