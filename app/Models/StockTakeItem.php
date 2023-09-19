<?php

namespace App\Models;

use App\Models\Eksemplar;
use App\Models\StockOpname;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockTakeItem extends Model
{
    use HasFactory, HasUuids;

    function stockopname() {
        return $this->belongsTo(StockOpname::class, 'stock_opname_id', 'id');
    }

    function eksemplar() {
        return $this->belongsTo(Eksemplar::class, 'eksemplar_id', 'id');
    }

    function bookstatus() {
        return $this->hasMany(BookStatus::class, 'book_status_id', 'id');
    }
    protected $guarded = [
        'id',

    ];

}
