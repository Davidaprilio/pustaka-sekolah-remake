<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $appends = [
        'cover_url'
    ];

    protected $casts = [
        // 'files' => AsArrayObject::class
    ];


    public function getCoverUrlAttribute()
    {
        return url('/' . $this->cover);
    }
}
