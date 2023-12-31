<?php

namespace App\Models;

use App\Models\Biblio;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Author extends Model
{
    use HasFactory;
    protected $table = 'author';
    function biblio() {
        return $this->hasOne(Biblio::class, 'biblio_id', 'id');
    }
    protected $guarded = [
        'id',
    ];
}
