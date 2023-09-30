<?php

namespace App\Models;

use App\Models\Biblio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CollType extends Model
{
    use HasFactory;

    protected $table = 'coll_type';

    function biblio() {
        return $this->belongsTo(Biblio::class, 'biblio_id', 'id');
    }

    protected $guarded = [
        'id',
    ];
}
