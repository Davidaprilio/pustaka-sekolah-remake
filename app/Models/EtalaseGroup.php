<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EtalaseGroup extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function etalase()
    {
        return $this->hasMany(EtalaseBook::class);
    }
}
