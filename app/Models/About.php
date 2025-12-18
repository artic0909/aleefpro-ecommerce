<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
        'header_logo',
        'footer_logo',
        'map_iframe_view',
        'breadcrumb',
        'side_image',
        'moto',
        'vision',
    ];
}
