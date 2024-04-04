<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseDetail extends Model
{
    use HasFactory;

    protected $table = 'purchaseorderdetails';

    protected $fillable = [
        'purchaseOrderID',
        'productID',
        'qty',
        'priceForEach'
    ];

    //Disables default expectation of the 'created_at' and 'updated_at' columns in the table
    public $timestamps = false;    

    // Creates relationship between Purchase Detail & Product

    public function product(){
        return $this->belongsTo(Product::class,'productID','productID');
    }
}
