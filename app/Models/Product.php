<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'sub_category_id',
        'product_name',
        'product_code',
        'images',
        'sizes',
        'colors',
        'description',
        'information',
        'actual_price',
        'selling_price',
        'size_chart_image',
        'slug',
        'front_selected_cords',
        'back_selected_cords',
        'front_customize',
        'back_customize',
        'stock_status',
        'min_purchase',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function mainCategory()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
