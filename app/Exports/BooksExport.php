<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class BooksExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        return Book::with('bookshelf')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Judul',
            'Penulis',
            'Tahun',
            'Penerbit',
            'Kota',
            'Cover URL',
            'Rak Buku',
            'Tanggal Dibuat',
        ];
    }

    public function map($book): array
    {
        return [
            $book->id,
            $book->title,
            $book->author,
            $book->year,
            $book->publisher,
            $book->city,
            $book->cover,
            $book->bookshelf->name ?? '-',
            $book->created_at->format('d M Y'),
        ];
    }
}