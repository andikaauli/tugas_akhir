<?php

namespace App\Models;

use App\Models\Type;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;


class Visitor extends Model
{
    use HasFactory, HasUuids;

    // protected $table = 'visitor'; //utk deklarasi perubahan nama sesuai keinginan

    function type() {
        return $this->belongsTo(Type::class, 'jenis_id', 'id');
    }
    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'name', 'institution', 'jenis_id'

    ];
}
