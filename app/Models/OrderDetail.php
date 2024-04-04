<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'orderdetail';

    protected $fillable = [
        'orderID',
        'productID',
        'qty',
        'priceForEach'
    ];

    //Disables default expectation of the 'created_at' and 'updated_at' columns in the table
    public $timestamps = false;

    // Creates relationship between OrderDetail and Product
    public function product(){
        return $this->belongsTo(Product::class,'productID','productID');
    }
}
