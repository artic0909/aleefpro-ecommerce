<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomEnquiry extends Model
{
        protected $fillable = [
        'company_logo',
        'product_customize_image',
        'logo_placement',
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
