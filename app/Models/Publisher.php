<?php

namespace App\Models;

use App\Models\Biblio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publisher extends Model
{
    use HasFactory;

    protected $table = 'publisher';

    function biblio() {
        return $this->hasOne(Biblio::class, 'biblio_id', 'id');
    }

    protected $guarded = [
        'id',
    ];
}
