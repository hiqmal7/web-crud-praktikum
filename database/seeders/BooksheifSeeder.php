<?php

namespace Database\Seeders;

use App\Models\Booksheif;
use Illuminate\Database\Seeder;

class BooksheifSeeder extends Seeder
{
    public function run(): void
    {
        $rak = [
            ['code' => 'A-001', 'name' => 'Rak Fiksi'],
            ['code' => 'A-002', 'name' => 'Rak Non-Fiksi'],
            ['code' => 'B-001', 'name' => 'Rak Referensi'],
            ['code' => 'B-002', 'name' => 'Rak Jurnal'],
            ['code' => 'C-001', 'name' => 'Rak Skripsi'],
        ];

        foreach ($rak as $r) {
            Booksheif::create($r);
        }
    }
}