<?php

namespace App\Models;

use App\Models\Eksemplar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Biblio extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = "biblio";

    protected $guarded = [
        'id',

    ];

    function eksemplar() {
        return $this->hasMany(Eksemplar::class, 'biblio_id', 'id');
    }
}
