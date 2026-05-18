<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Loan;
use App\Models\LoanDetail;
use App\Models\ReturnModel;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Tampilkan dashboard dengan statistik sederhana.
     */
    public function index(): View
    {
        $totalBooks    = Book::count();
        $totalUsers    = User::count();
        $activeLoans   = Loan::whereHas('loanDetails', fn($q) => $q->where('is_return', false))->count();
        $borrowedBooks = LoanDetail::where('is_return', false)->count();
        $totalReturns  = ReturnModel::count();
        $totalFines    = ReturnModel::where('charge', true)->sum('amount');

        return view('dashboard', compact(
            'totalBooks', 'totalUsers', 'activeLoans',
            'borrowedBooks', 'totalReturns', 'totalFines'
        ));
    }
}