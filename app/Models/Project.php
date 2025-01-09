<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    protected $fillable = [
        'name_az',
        'name_en',
        'name_ru',
        'slug_az',
        'slug_en',
        'slug_ru',
        'text1_az',
        'text1_en',
        'text1_ru',
        'text2_az',
        'text2_en',
        'text2_ru',
        'description1_az',
        'description1_en',
        'description1_ru',
        'description2_az',
        'description2_en',
        'description2_ru',
        'image',
        'bottom_images',
        'bottom_images_alt',
        'status',
        'image_alt_az',
        'image_alt_en',
        'image_alt_ru'
    ];

    protected $casts = [
        'status' => 'boolean',
        'bottom_images' => 'array',
        'bottom_images_alt' => 'array'
    ];

    public function getNameAttribute()
    {
        return $this->{'name_' . app()->getLocale()};
    }

    public function getText1Attribute()
    {
        return $this->{'text1_' . app()->getLocale()};
    }

    public function getText2Attribute()
    {
        return $this->{'text2_' . app()->getLocale()};
    }

    public function getDescription1Attribute()
    {
        return $this->{'description1_' . app()->getLocale()};
    }

    public function getDescription2Attribute()
    {
        return $this->{'description2_' . app()->getLocale()};
    }

    public function getImageAltAttribute()
    {
        return $this->{'image_alt_' . app()->getLocale()};
    }

    public function getBottomImagesAltAttribute($value)
    {
        $defaultValue = ['az' => [], 'en' => [], 'ru' => []];
        $currentLocale = app()->getLocale();
        
        if (is_null($value)) {
            return $defaultValue[$currentLocale];
        }
        
        $decodedValue = is_array($value) ? $value : json_decode($value, true);
        return $decodedValue[$currentLocale] ?? [];
    }

    protected function setBottomImagesAltAttribute($value)
    {
        $this->attributes['bottom_images_alt'] = is_array($value) ? 
            json_encode($value) : 
            json_encode(['az' => [], 'en' => [], 'ru' => []]);
    }

    // Slug oluşturma
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->slug_az = $model->name_az ? Str::slug($model->name_az) : null;
            $model->slug_en = $model->name_en ? Str::slug($model->name_en) : null;
            $model->slug_ru = $model->name_ru ? Str::slug($model->name_ru) : null;
        });

        static::updating(function ($model) {
            $model->slug_az = $model->name_az ? Str::slug($model->name_az) : null;
            $model->slug_en = $model->name_en ? Str::slug($model->name_en) : null;
            $model->slug_ru = $model->name_ru ? Str::slug($model->name_ru) : null;
        });
    }
}