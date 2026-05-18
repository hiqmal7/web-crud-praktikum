<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReturnModel extends Model
{
    protected $table = 'returns';
    protected $fillable = ['loan_detail_id', 'charge', 'amount'];

    protected function casts(): array
    {
        return [
            'charge' => 'boolean',
            'amount' => 'integer',
        ];
    }

    public function loanDetail()
    {
        return $this->belongsTo(LoanDetail::class, 'loan_detail_id');
    }
}