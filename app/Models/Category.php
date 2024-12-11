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
        'status'
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}