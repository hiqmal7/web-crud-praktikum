<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class LoanController extends Controller
{
    /**
     * Tampilkan daftar peminjaman beserta statusnya.
     */
    public function index(): View
    {
        $loans = Loan::with('user', 'loanDetails.book')
            ->latest()
            ->paginate(10);

        return view('loans.index', compact('loans'));
    }

    /**
     * Form peminjaman baru (memilih user & buku).
     */
    public function create(): View
    {
        $users = User::select('npm', 'first_name', 'last_name')->get();
        $books = Book::select('id', 'title')->get();

        return view('loans.create', compact('users', 'books'));
    }

    /**
     * Simpan header peminjaman + detail buku yang dipinjam.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'user_npm'  => 'required|exists:users,npm',
            'loan_at'   => 'required|date',
            'return_at' => 'required|date|after:loan_at',
            'book_ids'  => 'required|array|min:1',
            'book_ids.*'=> 'required|exists:books,id',
        ]);

        // Buat header pinjaman
        $loan = Loan::create([
            'user_npm'  => $validated['user_npm'],
            'loan_at'   => $validated['loan_at'],
            'return_at' => $validated['return_at'],
        ]);

        // Simpan detail buku
        foreach ($validated['book_ids'] as $bookId) {
            $loan->loanDetails()->create([
                'book_id'   => $bookId,
                'is_return' => false,
            ]);
        }

        return redirect()->route('loans.index')
            ->with('success', 'Peminjaman berhasil ditambahkan!');
    }

    /**
     * Detail satu peminjaman lengkap dengan buku & pengembalian.
     */
    public function show(Loan $loan): View
    {
        $loan->load('user', 'loanDetails.book', 'loanDetails.return');
        return view('loans.show', compact('loan'));
    }

    /**
     * Form edit header peminjaman (tanggal & user).
     */
    public function edit(Loan $loan): View
    {
        $users = User::select('npm', 'first_name', 'last_name')->get();
        return view('loans.edit', compact('loan', 'users'));
    }

    /**
     * Perbarui header peminjaman.
     */
    public function update(Request $request, Loan $loan): RedirectResponse
    {
        $validated = $request->validate([
            'user_npm'  => 'required|exists:users,npm',
            'loan_at'   => 'required|date',
            'return_at' => 'required|date|after:loan_at',
        ]);

        $loan->update($validated);

        return redirect()->route('loans.index')
            ->with('success', 'Peminjaman berhasil diperbarui!');
    }

    /**
     * Hapus peminjaman jika semua buku sudah dikembalikan.
     */
    public function destroy(Loan $loan): RedirectResponse
    {
        $unreturned = $loan->loanDetails()->where('is_return', false)->count();
        if ($unreturned > 0) {
            return redirect()->route('loans.index')
                ->with('error', "Tidak bisa dihapus, masih ada {$unreturned} buku belum dikembalikan!");
        }

        $loan->delete();

        return redirect()->route('loans.index')
            ->with('success', 'Peminjaman berhasil dihapus!');
    }
}