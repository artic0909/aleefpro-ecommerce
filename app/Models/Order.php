<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'customer_id',
        'product_details',
        'overall_amount',
        'payment_id',
        'amount',
        'currency',
        'payment_status',
        'order_date',
    ];

    // Automatically cast JSON to array
    protected $casts = [
        'product_details' => 'array',
        'overall_amount'  => 'decimal:2',
        'amount'          => 'decimal:2',
    ];

    /**
     * Relationship: An order belongs to a customer
     */
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
