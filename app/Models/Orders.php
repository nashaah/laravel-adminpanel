<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Orders extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = [
        'id',
        'customerID',
        'employeeID',
        'orderDate',
        'orderTotalPrice',
        'orderStatus',
        'notes'
    ];

    //Disables default expectation of the 'created_at' and 'updated_at' columns in the table
    public $timestamps = false;

    // Creates relationship between Order and Order Details
    
    public function orderDetails(): HasMany{
        return $this->hasMany(OrderDetail::class,'orderID','id');
    }

    // Creates relationship between Order & Customer, Employee and Invoice

    public function customer(){
        return $this->belongsTo(Customer::class,'customerID','customerID');
    }

    public function employee(){
        return $this->belongsTo(Employee::class,'employeeID','employeeID');
    }

    public function invoice(){
        return $this->hasOne(Invoice::class,'orderID','id')->onDelete(function ($invoice) {
            $invoice->payments()->delete();
    });
    }
}
