<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
        'title', 'author', 'year', 'publisher',
        'city', 'cover', 'bookshelf_id'
    ];

    protected function casts(): array
    {
        return ['year' => 'integer'];
    }

    public function bookshelf()
    {
        return $this->belongsTo(Booksheif::class, 'bookshelf_id');
    }

    public function loanDetails()
    {
        return $this->hasMany(LoanDetail::class);
    }
}