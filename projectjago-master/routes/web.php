<?php

use App\Http\Controllers\FormController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TalentController;

// Halaman Utama - Menampilkan halaman welcome
Route::get('/', function () {
    return view('welcome'); // Mengarahkan ke halaman welcome
})->name('welcome');

// Halaman Pendaftaran - Menampilkan halaman register
Route::get('/register', function () {
    return view('register'); // Mengarahkan ke halaman register
})->name('register');

// Halaman Dashboard - Hanya bisa diakses oleh pengguna yang sudah login
Route::get('/dashboard', function () {
    return view('dashboard'); // Di sini kita akan mengisi data talent
})->middleware(['auth', 'verified'])->name('dashboard');

// Profile Routes untuk user yang sudah login
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route untuk Form Pendaftaran Talent
Route::get('/register-talent', [TalentController::class, 'showForm'])->name('register.talent');
Route::post('/submit-form', [TalentController::class, 'submitForm'])->name('submit.form');

// Halaman Performance (Jika diperlukan)
Route::get('/performance', function () {
    return view('performance');
})->name('performance');

// Require Authentication Routes (Login dan Register)
require __DIR__.'/auth.php';