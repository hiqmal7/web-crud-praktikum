<?php

namespace App\Http\Controllers;

use App\Models\LoanDetail;
use App\Models\Loan;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class LoanDetailController extends Controller
{
    /**
     * Daftar semua detail peminjaman.
     */
    public function index(): View
    {
        $loanDetails = LoanDetail::with('loan.user', 'book', 'return')
            ->latest()
            ->paginate(15);

        return view('loan_details.index', compact('loanDetails'));
    }

    /**
     * Form tambah detail (menambah buku ke pinjaman).
     */
    public function create(): View
    {
        $loans = Loan::select('id', 'user_npm', 'loan_at')->get();
        $books = Book::select('id', 'title')->get();

        return view('loan_details.create', compact('loans', 'books'));
    }

    /**
     * Simpan detail peminjaman baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'book_id' => 'required|exists:books,id',
        ]);

        // Cegah duplikasi buku dalam satu pinjaman
        $exists = LoanDetail::where('loan_id', $validated['loan_id'])
            ->where('book_id', $validated['book_id'])
            ->exists();

        if ($exists) {
            return back()->with('error', 'Buku sudah ada dalam peminjaman ini!');
        }

        LoanDetail::create([
            'loan_id'   => $validated['loan_id'],
            'book_id'   => $validated['book_id'],
            'is_return' => false,
        ]);

        return redirect()->route('loan_details.index')
            ->with('success', 'Detail peminjaman berhasil ditambahkan!');
    }

    /**
     * Detail satu detail peminjaman.
     */
    public function show(LoanDetail $loanDetail): View
    {
        $loanDetail->load('loan.user', 'book', 'return');
        return view('loan_details.show', compact('loanDetail'));
    }

    /**
     * Form edit detail peminjaman.
     */
    public function edit(LoanDetail $loanDetail): View
    {
        $loans = Loan::select('id', 'user_npm', 'loan_at')->get();
        $books = Book::select('id', 'title')->get();

        return view('loan_details.edit', compact('loanDetail', 'loans', 'books'));
    }

    /**
     * Perbarui detail peminjaman.
     */
    public function update(Request $request, LoanDetail $loanDetail): RedirectResponse
    {
        $validated = $request->validate([
            'loan_id' => 'required|exists:loans,id',
            'book_id' => 'required|exists:books,id',
        ]);

        $loanDetail->update($validated);

        return redirect()->route('loan_details.index')
            ->with('success', 'Detail peminjaman berhasil diperbarui!');
    }

    /**
     * Hapus detail peminjaman (hanya jika belum ada pengembalian).
     */
    public function destroy(LoanDetail $loanDetail): RedirectResponse
    {
        if ($loanDetail->return) {
            return redirect()->route('loan_details.index')
                ->with('error', 'Tidak bisa dihapus karena sudah ada data pengembalian!');
        }

        $loanDetail->delete();

        return redirect()->route('loan_details.index')
            ->with('success', 'Detail peminjaman berhasil dihapus!');
    }

    /**
     * Tandai buku sebagai sudah dikembalikan.
     */
    public function markAsReturned(LoanDetail $loanDetail): RedirectResponse
    {
        if ($loanDetail->is_return) {
            return back()->with('error', 'Buku sudah ditandai dikembalikan!');
        }

        $loanDetail->update(['is_return' => true]);

        return back()->with('success', 'Buku berhasil ditandai sebagai dikembalikan!');
    }

    public function printPdf()
    {
        $loanDetails = LoanDetail::with('loan.user', 'book', 'return')->latest()->get();
        $pdf = Pdf::loadView('loan_details.pdf', compact('loanDetails'))
              ->setPaper('a4', 'landscape');
        return $pdf->download('daftar-detail-peminjaman.pdf');
    }
}