<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Tampilkan daftar semua kategori.
     */
    public function index(): View
    {
        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Form tambah kategori.
     */
    public function create(): View
    {
        return view('categories.create');
    }

    /**
     * Simpan kategori baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255|unique:categories,category',
        ]);

        Category::create($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil ditambahkan!');
    }

    /**
     * Tampilkan detail satu kategori.
     */
    public function show(Category $category): View
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Form edit kategori.
     */
    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Perbarui data kategori.
     */
    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'category' => 'required|string|max:255|unique:categories,category,' . $category->id,
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil diperbarui!');
    }

    /**
     * Hapus kategori.
     */
    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();

        return redirect()->route('categories.index')
            ->with('success', 'Kategori berhasil dihapus!');
    }
}