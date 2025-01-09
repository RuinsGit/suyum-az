<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title_az',
        'title_en',
        'title_ru',
        'description_az',
        'description_en',
        'description_ru',
        'image',
        'bottom_image',
        'status',
        'image_alt_az',
        'image_alt_en',
        'image_alt_ru',
        'bottom_image_alt_az',
        'bottom_image_alt_en',
        'bottom_image_alt_ru'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function getTitleAttribute()
    {
        return $this->{'title_' . app()->getLocale()};
    }

    public function getDescriptionAttribute()
    {
        return $this->{'description_' . app()->getLocale()};
    }

    public function getImageAltAttribute()
    {
        return $this->{'image_alt_' . app()->getLocale()};
    }

    public function getBottomImageAltAttribute()
    {
        return $this->{'bottom_image_alt_' . app()->getLocale()};
    }
            
}
