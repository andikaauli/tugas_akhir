<?php

namespace App\Models;

use App\Models\Member;
use App\Models\Eksemplar;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Loan extends Model
{
    use HasFactory, HasUuids;

    function eksemplar() {
        return $this->belongsTo(Eksemplar::class, 'eksemplar_id', 'id');
    }

    function member() {
        return $this->belongsTo(Member::class, 'member_id', 'id');
    }

    protected $guarded = [
        'id',

    ];
}
