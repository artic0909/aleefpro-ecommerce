<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    public $fillable = [
        'user_id',
        'payment_id',
        'amount',
        'currency',
        'payment_status',
        'cart_details',
    ];
}
