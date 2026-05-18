<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booksheif extends Model
{
    protected $table = 'booksheifs';
    protected $fillable = ['code', 'name'];

    public function books()
    {
        return $this->hasMany(Book::class, 'bookshelf_id');
    }
}