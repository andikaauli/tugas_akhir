<?php

namespace App\Models;

use App\Models\Biblio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publisher extends Model
{
    use HasFactory;

    function biblio() {
        return $this->belongsTo(Biblio::class, 'biblio_id', 'id');
    }
}
