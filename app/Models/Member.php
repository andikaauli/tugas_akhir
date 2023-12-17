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
    protected $table = 'members';
    function loan() {
        return $this->hasMany(Loan::class, 'member_id', 'id');
    }
    protected $guarded = [
        'id',
    ];

    // protected $encrypt = [
    //     'name',
    //     'nim',
    //     'email',
    //     'phone',
    //     'address',
    //     'institution',

    // ];

    // public function setAttribute($key, $value){
    //     if(in_array($key, $this->encrypt)){
    //         $this->attributes[$key] = encrypt($value);
    //     } else {
    //         parent::setAttribute($key, $value);
    //     }
    // }

    // public function getAttribute($key){
    //     if (in_array($key, $this->encrypt) && !empty($this->attributes[$key])) {
    //         try {
    //             return decrypt($this->attributes[$key]);
    //         } catch (\Throwable $th) {
    //             return $this->attributes[$key];
    //         }
    //     }
    //         return parent::getAttribute($key);

    // }
}
