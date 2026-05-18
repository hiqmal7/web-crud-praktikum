<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 1; $i <= 50; $i++) {
            $angkatan = rand(21, 25);                         // 21 - 25
            $urutan   = str_pad($i, 3, '0', STR_PAD_LEFT);   // 001 - 050
            $npm      = '55201' . $angkatan . $urutan;        // contoh: 5520122001

            User::create([
                'npm'        => $npm,
                'first_name' => fake()->firstName(),
                'last_name'  => fake()->lastName(),
                'email'      => fake()->unique()->safeEmail(),
                'password'   => Hash::make('password'),       // password default: password
            ]);
        }
    }
}