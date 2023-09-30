<?php

namespace App\Models;

use App\Models\StockTakeItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockOpname extends Model
{
    use HasFactory, HasUuids;
    protected $table = 'stock_opname';
    function stocktakeitem() {
        return $this->hasMany(StockTakeItem::class, 'stock_opname_id', 'id');
    }
    protected $guarded = [
        'id',

    ];
}
