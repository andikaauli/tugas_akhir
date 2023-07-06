<?php

namespace App\Models;

use App\Models\Eksemplar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BookStatus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    function eksemplar() {
        return $this->hasMany(Eksemplar::class, 'book_status_id', 'id');
    }
}
