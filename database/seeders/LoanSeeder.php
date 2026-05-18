<?php

namespace Database\Seeders;

use App\Models\Loan;
use App\Models\LoanDetail;
use App\Models\ReturnModel;
use App\Models\User;
use App\Models\Book;
use Illuminate\Database\Seeder;

class LoanSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::pluck('npm')->toArray();
        $books = Book::pluck('id')->toArray();

        for ($i = 1; $i <= 20; $i++) {
            // Buat header peminjaman
            $loan = Loan::create([
                'user_npm'  => fake()->randomElement($users),
                'loan_at'   => fake()->dateTimeBetween('-2 months', '-1 week')->format('Y-m-d'),
                'return_at' => fake()->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            ]);

            // Buat detail buku (1-3 buku)
            $detailCount = rand(1, 3);
            $bookSample = fake()->randomElements($books, $detailCount);

            foreach ($bookSample as $bookId) {
                $isReturn = (rand(0, 1) === 1); // 50% sudah dikembalikan
                $detail = LoanDetail::create([
                    'loan_id'   => $loan->id,
                    'book_id'   => $bookId,
                    'is_return' => $isReturn,
                ]);

                // Jika sudah dikembalikan, buat data pengembalian
                if ($isReturn) {
                    $charge = fake()->boolean(30); // 30% kena denda
                    $amount = $charge ? fake()->numberBetween(5000, 50000) : 0;

                    ReturnModel::create([
                        'loan_detail_id' => $detail->id,
                        'charge'         => $charge,
                        'amount'         => $amount,
                    ]);
                }
            }
        }
    }
}