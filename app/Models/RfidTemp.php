<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RfidTemp extends Model
{
    use HasFactory;
    protected $table = 'rfidtemp';
    protected $guarded = [
        'id',
    ];
}
