<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasFactory, HasApiTokens, Notifiable;

    protected $table = "employee";

    protected $fillable = [
        'employeeID',
        'employeeName',
        'employeeDivision',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];


}
