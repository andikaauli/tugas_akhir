<?php

namespace App\Models;

// use App\Models\author;
use App\Models\Author;
use App\Models\Colltype;
// use App\Models\CollType;
use App\Models\Eksemplar;
use App\Models\Publisher;
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

    function eksemplar()
    {
        return $this->hasMany(Eksemplar::class, 'biblio_id', 'id');
    }

    function author()
    {
        return $this->belongsTo(Author::class, 'author_id', 'id',);
    }

    function colltype()
    {
        return $this->belongsTo(CollType::class, 'coll_type_id', 'id');
    }

    function publisher()
    {
        return $this->belongsTo(Publisher::class, 'publisher_id', 'id');
    }
}
