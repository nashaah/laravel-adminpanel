<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempPurchase extends Model
{
    use HasFactory;

    protected $table = "temp_purchase";

    protected $fillable = [
        'id',
        'purchaseOrderID',
        'productID',
        'qty',
        'priceForEach'
    ];

    public $timestamps = false;
}
