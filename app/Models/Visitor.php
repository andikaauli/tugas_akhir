<?php

namespace App\Models;

use App\Models\Type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visitor extends Model
{
    use HasFactory;

    // protected $table = 'visitor'; utk deklarasi perubahan nama sesuai keinginan

    function type() {
        return $this->belongsTo(Type::class, 'jenis_id', 'id');
    }
    protected $guarded = [
        'id',

    ];
}
