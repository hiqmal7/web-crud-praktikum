<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class BooksImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Book([
            'title'        => $row['judul'],
            'author'       => $row['penulis'],
            'year'         => $row['tahun'],
            'publisher'    => $row['penerbit'],
            'city'         => $row['kota'],
            'cover'        => $row['cover_url'] ?? 'https://via.placeholder.com/200x300',
            'bookshelf_id' => $row['bookshelf_id'],
        ]);
    }

    public function rules(): array
    {
        return [
            'judul'         => 'required|string|max:255',
            'penulis'       => 'required|string|max:255',
            'tahun'         => 'required|integer|min:1900|max:' . date('Y'),
            'penerbit'      => 'required|string|max:255',
            'kota'          => 'required|string|max:255',
            'bookshelf_id'  => 'required|exists:booksheifs,id',
        ];
    }
}