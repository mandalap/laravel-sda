<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\DetailsController;
use App\Http\Controllers\ListCityController;
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
Route::get('/tanah-kota', [ListCityController::class, 'tanahkota'])->name('tanahkota');
Route::get('/tanah-kota/{slug}', [ListCityController::class, 'detailtanakota'])->name('detailtanakota');

/// Details
Route::get('/tanah-kavling/{slug}', [DetailsController::class, 'index'])->name('detailstanahkavling');
Route::get('/tanah-kavling/{slug}/cust-info', [DetailsController::class, 'custinfo'])->name('custinfo');
Route::get('/tanah-kavling/{slug}/checkout', [DetailsController::class, 'checkout'])->name('checkout');


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
