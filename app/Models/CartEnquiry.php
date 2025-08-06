<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartEnquiry extends Model
{
    protected $fillable = [
        'customer_id',
        'enquiry_data',
        'overall_amount',
        'enquiry_date',
        'remark',
    ];

    protected $casts = [
        'enquiry_data' => 'array',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    
}
