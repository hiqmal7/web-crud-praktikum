<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    /**
     * Tentukan apakah pengguna diizinkan membuat request ini.
     */
    public function authorize(): bool
    {
        return true; // semua user yang sudah login bisa menambah buku
    }

    /**
     * Aturan validasi untuk menyimpan buku baru.
     */
    public function rules(): array
    {
        return [
            'title'        => 'required|string|max:255',
            'author'       => 'required|string|max:255',
            'year'         => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'publisher'    => 'required|string|max:255',
            'city'         => 'required|string|max:255',
            'cover'        => 'required|string|max:255',  // URL cover, wajib diisi
            'bookshelf_id' => 'required|exists:booksheifs,id',
        ];
    }

    /**
     * Pesan kesalahan kustom (opsional).
     */
    public function messages(): array
    {
        return [
            'title.required'         => 'Judul buku wajib diisi.',
            'author.required'        => 'Nama penulis wajib diisi.',
            'year.required'          => 'Tahun terbit wajib diisi.',
            'year.digits'            => 'Tahun harus 4 digit.',
            'publisher.required'     => 'Penerbit wajib diisi.',
            'city.required'          => 'Kota terbit wajib diisi.',
            'cover.required'         => 'URL cover wajib diisi.',
            'bookshelf_id.required'  => 'Rak buku harus dipilih.',
            'bookshelf_id.exists'    => 'Rak buku yang dipilih tidak valid.',
        ];
    }
}