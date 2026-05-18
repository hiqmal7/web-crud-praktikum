<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Booksheif;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BookController extends Controller
{
    /**
     * Menampilkan daftar buku (10 per halaman).
     */
    public function index(): View
    {
        $books = Book::with('bookshelf')   // eager load relasi rak buku
                    ->latest()             // data terbaru dulu
                    ->paginate(10);        // paginasi

        return view('books.index', compact('books'));
    }

    /**
     * Form untuk menambah buku.
     */
    public function create(): View
    {
        $booksheifs = Booksheif::all();    // data rak buku untuk dropdown
        return view('books.create', compact('booksheifs'));
    }

    /**
     * Simpan data buku baru.
     */
    public function store(StoreBookRequest $request): RedirectResponse
    {
        // Validasi dilakukan otomatis oleh StoreBookRequest
        Book::create($request->validated());

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail satu buku.
     */
    public function show(Book $book): View
    {
        // Load relasi untuk tampilan detail
        $book->load('bookshelf');
        return view('books.show', compact('book'));
    }

    /**
     * Form edit buku.
     */
    public function edit(Book $book): View
    {
        $booksheifs = Booksheif::all();
        return view('books.edit', compact('book', 'booksheifs'));
    }

    /**
     * Perbarui data buku.
     */
    public function update(UpdateBookRequest $request, Book $book): RedirectResponse
    {
        $book->update($request->validated());

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil diperbarui!');
    }

    /**
     * Hapus buku.
     */
    public function destroy(Book $book): RedirectResponse
    {
        $book->delete();

        return redirect()
            ->route('books.index')
            ->with('success', 'Buku berhasil dihapus!');
    }
}