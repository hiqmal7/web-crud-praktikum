<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BooksheifController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\LoanDetailController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\ProfileController;
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

// Route autentikasi (register, login, logout, dll.) dari Breeze
require __DIR__.'/auth.php';

// Semua route di bawah ini hanya bisa diakses setelah login
Route::middleware(['auth'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ========== Cetak PDF ==========
    Route::get('/books/print-pdf', [BookController::class, 'printPdf'])->name('books.print-pdf');
    Route::get('/booksheifs/print-pdf', [BooksheifController::class, 'printPdf'])->name('booksheifs.print-pdf');
    Route::get('/categories/print-pdf', [CategoryController::class, 'printPdf'])->name('categories.print-pdf');
    Route::get('/loans/print-pdf', [LoanController::class, 'printPdf'])->name('loans.print-pdf');
    Route::get('/loan_details/print-pdf', [LoanDetailController::class, 'printPdf'])->name('loan_details.print-pdf');
    Route::get('/returns/print-pdf', [ReturnController::class, 'printPdf'])->name('returns.print-pdf');

    // ========== Export & Import Excel (Books) ==========
    Route::get('/books/export-excel', [BookController::class, 'exportExcel'])->name('books.export-excel');
    Route::get('/books/import', [BookController::class, 'importForm'])->name('books.import');
    Route::post('/books/import', [BookController::class, 'importExcel'])->name('books.import-excel');

    // ========== Resource Routes untuk CRUD ==========
    Route::resource('books', BookController::class);
    Route::resource('booksheifs', BooksheifController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('loans', LoanController::class);
    Route::resource('loan_details', LoanDetailController::class);
    Route::resource('returns', ReturnController::class);

    // Tandai buku sudah dikembalikan (PATCH)
    Route::patch('loan_details/{loanDetail}/mark-returned', [LoanDetailController::class, 'markAsReturned'])
        ->name('loan_details.mark-returned');

    // Route Profile (nonaktifkan jika tidak diperlukan)
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});