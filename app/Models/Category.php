<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name_az',
        'name_en',
        'name_ru',
        'description_az',
        'description_en',
        'description_ru',
        'image',
        'button_image',
        'button_image_alt_az',
        'button_image_alt_en',
        'button_image_alt_ru',
        'status'
    ];

    public function getImageAttribute($value)
    {
        return $value;
    }

    public function getButtonImageAttribute($value)
    {
        return $value;
    }

    public function getNameAttribute()
    {
        return $this->{'name_' . app()->getLocale()};
    }
    

    public function getDescriptionAttribute()
    {
        return $this->{'description_' . app()->getLocale()};
    }

    public function getButtonImageAltAttribute()
    {
        return $this->{'button_image_alt_' . app()->getLocale()};
    }

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}