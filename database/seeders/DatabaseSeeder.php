<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            BooksheifSeeder::class,
            CategorySeeder::class,
            BookSeeder::class,
            LoanSeeder::class,      // sekaligus mengisi loan_details & returns
        ]);
    }
}