<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    protected $fillable = ['user_npm', 'loan_at', 'return_at'];

    protected function casts(): array
    {
        return [
            'loan_at' => 'date',
            'return_at' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_npm', 'npm');
    }

    public function loanDetails()
    {
        return $this->hasMany(LoanDetail::class);
    }
}