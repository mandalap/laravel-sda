<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\CekBookingController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\ListCityController;
use App\Http\Controllers\PencarianController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\RegisterController;

Route::post('/postlogin', [RegisterController::class, 'postlogin'])->name('postlogin');

// Daftar
Route::get('/daftar', [RegisterController::class, 'daftar'])->name('daftar');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

// Password
Route::get('/lupa-password', [RegisterController::class, 'lupapassword'])->name('lupapassword');
Route::post('/reset-password', [RegisterController::class, 'resetpassword'])->name('resetpassword');

// Logout
// Route::get('/logout', [RegisterController::class, 'logout'])->name('logout');

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


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth:member')->group(function () {
    // Beranda
    Route::get('/beranda', [BerandaController::class, 'beranda'])->name('beranda');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
