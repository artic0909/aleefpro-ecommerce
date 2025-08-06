<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScrollBanners extends Model
{
    protected $table = 'scroll_banners';

    protected $fillable = [
        'image',
    ];

    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
