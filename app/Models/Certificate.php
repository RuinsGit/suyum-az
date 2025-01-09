<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'text_az',
        'text_en',
        'text_ru',
        'image',
        'status',
        'image_alt_az',
        'image_alt_en',
        'image_alt_ru'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function getTextAttribute()
    {
        return $this->{'text_' . app()->getLocale()};
    }

    public function getImageAltAttribute()
    {
        return $this->{'image_alt_' . app()->getLocale()};
    }
}
