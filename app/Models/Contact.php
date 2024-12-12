<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'title1_az',
        'title1_en',
        'title1_ru',
        'title2_az',
        'title2_en',
        'title2_ru',
        'description_az',
        'description_en',
        'description_ru',
        'number',
        'image1',
        'image2',
        'image3',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}