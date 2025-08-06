<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductEnquiry extends Model
{
    protected $fillable = [
        'product_name',
        'product_code',
        'price',
        'main_sub_category',
        'colors',
        'sizes',
        'units',
        'customer_name',
        'customer_email',
        'customer_mobile',
        'customer_address',
        'detail_enquiry',
        'enquiry_date',
        'remark',
    ];

    protected $casts = [
        'enquiry_date' => 'date',
    ];
}
