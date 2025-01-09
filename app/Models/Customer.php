<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'image',
        'link',
        'status',
        'image_alt_az',
        'image_alt_en',
        'image_alt_ru'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function getImageAltAttribute()
    {
        return $this->{'image_alt_' . app()->getLocale()};
    }
}