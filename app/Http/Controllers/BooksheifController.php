<?php

namespace App\Http\Controllers;

use App\Models\Booksheif;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

class BooksheifController extends Controller
{
    /**
     * Tampilkan daftar rak buku dengan jumlah buku di dalamnya.
     */
    public function index(): View
    {
        $booksheifs = Booksheif::withCount('books')
            ->latest()
            ->paginate(10);

        return view('booksheifs.index', compact('booksheifs'));
    }

    /**
     * Form tambah rak buku.
     */
    public function create(): View
    {
        return view('booksheifs.create');
    }

    /**
     * Simpan rak buku baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:booksheifs,code',
            'name' => 'required|string|max:255',
        ]);

        Booksheif::create($validated);

        return redirect()->route('booksheifs.index')
            ->with('success', 'Rak buku berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail rak buku beserta buku-bukunya.
     */
    public function show(Booksheif $booksheif): View
    {
        $booksheif->load('books'); // eager load buku di rak ini
        return view('booksheifs.show', compact('booksheif'));
    }

    /**
     * Form edit rak buku.
     */
    public function edit(Booksheif $booksheif): View
    {
        return view('booksheifs.edit', compact('booksheif'));
    }

    /**
     * Perbarui data rak buku.
     */
    public function update(Request $request, Booksheif $booksheif): RedirectResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:10|unique:booksheifs,code,' . $booksheif->id,
            'name' => 'required|string|max:255',
        ]);

        $booksheif->update($validated);

        return redirect()->route('booksheifs.index')
            ->with('success', 'Rak buku berhasil diperbarui!');
    }

    /**
     * Hapus rak buku jika tidak ada buku di dalamnya.
     */
    public function destroy(Booksheif $booksheif): RedirectResponse
    {
        if ($booksheif->books()->count() > 0) {
            return redirect()->route('booksheifs.index')
                ->with('error', 'Rak tidak bisa dihapus karena masih ada buku di dalamnya!');
        }

        $booksheif->delete();

        return redirect()->route('booksheifs.index')
            ->with('success', 'Rak buku berhasil dihapus!');
    }

    public function printPdf()
    {
        $booksheifs = Booksheif::withCount('books')->latest()->get();
        $pdf = Pdf::loadView('booksheifs.pdf', compact('booksheifs'))
              ->setPaper('a4', 'portrait');
        return $pdf->download('daftar-rak-buku.pdf');
    }
}