<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtalaseBook extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function books()
    {
        return $this->belongsToMany(Book::class, 'pivot_etalase_books', 'etalase_book_id', 'book_id');
    }

    public function group()
    {
        return $this->belongsTo(EtalaseGroup::class, 'etalase_group_id');
    }
}
