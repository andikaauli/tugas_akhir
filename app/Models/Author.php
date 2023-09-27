<?php

namespace App\Models;

use App\Models\Biblio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    function biblio() {
        return $this->belongsTo(Biblio::class, 'biblio_id', 'id');
    }
}
