<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    protected $fillable = [

        'address_type',
        'user_id',
        'full_name',
        'address',
        'phone',
        'country',
        'state',
        'city',
        'zip_code'
    ];
}
