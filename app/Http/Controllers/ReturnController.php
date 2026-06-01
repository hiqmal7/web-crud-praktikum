<?php

namespace App\Http\Controllers;

use App\Models\ReturnModel;
use App\Models\LoanDetail;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class ReturnController extends Controller
{
    /**
     * Tampilkan daftar pengembalian.
     */
    public function index(): View
    {
        $returns = ReturnModel::with('loanDetail.loan.user', 'loanDetail.book')
            ->latest()
            ->paginate(10);

        return view('returns.index', compact('returns'));
    }

    /**
     * Form tambah pengembalian (memilih detail yang belum dikembalikan).
     */
    public function create(): View
    {
        $loanDetails = LoanDetail::with('loan.user', 'book')
            ->where('is_return', false)
            ->get();

        return view('returns.create', compact('loanDetails'));
    }

    /**
     * Simpan data pengembalian.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'loan_detail_id' => 'required|exists:loan_detail,id',
            'charge'         => 'required|boolean',
            'amount'         => 'nullable|integer|min:0',
        ]);

        // Cegah pengembalian ganda
        $exists = ReturnModel::where('loan_detail_id', $validated['loan_detail_id'])->exists();
        if ($exists) {
            return back()->with('error', 'Buku ini sudah memiliki data pengembalian!');
        }

        // Jika tidak ada denda, set amount = 0
        if (!$validated['charge']) {
            $validated['amount'] = 0;
        }

        // Simpan pengembalian
        ReturnModel::create([
            'loan_detail_id' => $validated['loan_detail_id'],
            'charge'         => $validated['charge'],
            'amount'         => $validated['amount'] ?? 0,
        ]);

        // Tandai loan_detail sebagai sudah kembali
        LoanDetail::where('id', $validated['loan_detail_id'])->update(['is_return' => true]);

        return redirect()->route('returns.index')
            ->with('success', 'Pengembalian berhasil dicatat!');
    }

    /**
     * Detail satu pengembalian.
     */
    public function show(ReturnModel $return): View
    {
        $return->load('loanDetail.loan.user', 'loanDetail.book');
        return view('returns.show', compact('return'));
    }

    /**
     * Form edit pengembalian (hanya charge & amount).
     */
    public function edit(ReturnModel $return): View
    {
        return view('returns.edit', compact('return'));
    }

    /**
     * Perbarui data pengembalian.
     */
    public function update(Request $request, ReturnModel $return): RedirectResponse
    {
        $validated = $request->validate([
            'charge' => 'required|boolean',
            'amount' => 'nullable|integer|min:0',
        ]);

        if (!$validated['charge']) {
            $validated['amount'] = 0;
        }

        $return->update($validated);

        return redirect()->route('returns.index')
            ->with('success', 'Data pengembalian berhasil diperbarui!');
    }

    /**
     * Hapus pengembalian (kembalikan status is_return ke false).
     */
    public function destroy(ReturnModel $return): RedirectResponse
    {
        // Kembalikan status peminjaman
        LoanDetail::where('id', $return->loan_detail_id)->update(['is_return' => false]);

        $return->delete();

        return redirect()->route('returns.index')
            ->with('success', 'Data pengembalian berhasil dihapus!');
    }

    public function printPdf()
    {
        $returns = ReturnModel::with('loanDetail.loan.user', 'loanDetail.book')->latest()->get();
        $pdf = Pdf::loadView('returns.pdf', compact('returns'))
              ->setPaper('a4', 'landscape');
        return $pdf->download('daftar-pengembalian.pdf');
    }

}