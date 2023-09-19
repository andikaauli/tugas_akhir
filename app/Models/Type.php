<?php

namespace App\Models;

use App\Models\Visitor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Type extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    function visitor() {
        return $this->hasMany(Visitor::class, 'jenis_id', 'id');
    }
    protected $guarded = [
        'id',

    ];
}
