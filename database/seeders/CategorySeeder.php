<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Pemrograman', 'Jaringan', 'Database', 'Multimedia',
            'Sistem Operasi', 'Kecerdasan Buatan', 'Manajemen',
            'Akuntansi', 'Bahasa', 'Sastra'
        ];

        foreach ($categories as $cat) {
            Category::create(['category' => $cat]);
        }
    }
}