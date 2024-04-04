<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TempOrder extends Model
{
    use HasFactory;

    protected $table = "temp_order";

    protected $fillable = [
        'id',
        'orderID',
        'productID',
        'qty',
        'priceForEach'
    ];

    public $timestamps = false;
}
