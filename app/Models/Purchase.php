<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Purchase extends Model
{
    use HasFactory;

    protected $table = 'purchaseorder';

    protected $fillable = [
        'id',
        'locationID',
        'purchaseDate',
        'totalPrice',
        'expectedArrival',
        'purchaseStatus'
    ];

    //Disables default expectation of the 'created_at' and 'updated_at' columns in the table
    public $timestamps = false;

    // Creates relationship between Purchase & Location

    public function location(){
        return $this->belongsTo(Location::class,'locationID','locationID');
    }

    // Creates relationship between Purchase & Purchase Details

    public function purchaseDetails(): HasMany{
        return $this->hasMany(PurchaseDetail::class,'purchaseOrderID','id');
    }
}
