<?php

namespace App\Models;

use App\Models\Loan;
use App\Models\Biblio;
use App\Models\BookStatus;
use App\Models\StockTakeItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eksemplar extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $table = 'eksemplar';

    protected $guarded = [
        'id',

    ];
    protected $fillable = [
        'rfid_code',
    ];

    function biblio() {
        return $this->belongsTo(Biblio::class, 'biblio_id', 'id');
    }

    function bookstatus() {
        return $this->belongsTo(BookStatus::class, 'book_status_id', 'id');
    }

    function loan() {
        return $this->hasMany(Loan::class, 'eksemplar_id', 'id');
    }

    function stocktakeitem() {
        return $this->hasOne(StockTakeItem::class, 'eksemplar_id', 'id');
    }


}
