<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BooksheifController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanDetailController;
use App\Http\Controllers\ReturnController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Halaman utama langsung redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Route untuk autentikasi (register, login, logout, dll.)
// File ini sudah disediakan oleh Laravel Breeze
require __DIR__.'/auth.php';

// Semua route di bawah ini hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // Resource Routes untuk CRUD
    Route::resource('books', BookController::class);
    Route::resource('booksheifs', BooksheifController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('loans', LoanController::class);
    Route::resource('loan_details', LoanDetailController::class);
    Route::resource('returns', ReturnController::class);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Route tambahan: menandai buku sudah dikembalikan (via PATCH)
    Route::patch('loan_details/{loanDetail}/mark-returned', [LoanDetailController::class, 'markAsReturned'])
        ->name('loan_details.mark-returned');
});