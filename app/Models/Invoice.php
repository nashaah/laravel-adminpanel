<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoice';

    protected $fillable = [
        'invoiceID',
        'orderID',
        'purchaseDate',
        'totalPrice',
        'expectedArrival',
        'purchaseStatus'
    ];

    // Create relationship between Invoice and Payments
    public function payment(){
        return $this->hasMany(Payment::class,'invoiceID','invoiceID')->onDelete('cascade');
    }
}
