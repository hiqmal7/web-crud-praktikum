<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Booksheif;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $bookshelfIds = Booksheif::pluck('id')->toArray();

        for ($i = 1; $i <= 50; $i++) {
            Book::create([
                'title'        => fake()->sentence(rand(2, 4)),
                'author'       => fake()->name(),
                'year'         => fake()->year(),
                'publisher'    => fake()->company(),
                'city'         => fake()->city(),
                'cover'        => 'https://picsum.photos/200/300?random=' . $i,
                'bookshelf_id' => fake()->randomElement($bookshelfIds),
            ]);
        }
    }
}