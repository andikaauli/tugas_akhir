<?php

namespace App\Models;

use App\Models\Loan;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    function loan() {
        return $this->hasMany(Loan::class, 'member_id', 'id');
    }
    protected $guarded = [
        'id',

    ];
}
