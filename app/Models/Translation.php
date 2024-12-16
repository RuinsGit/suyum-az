<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    protected $fillable = [
        'logo',
        'text1_az', 'text1_en', 'text1_ru',
        'text2_az', 'text2_en', 'text2_ru',
        'text3_az', 'text3_en', 'text3_ru',
        'text4_az', 'text4_en', 'text4_ru',
        'text5_az', 'text5_en', 'text5_ru',
        'text6_az', 'text6_en', 'text6_ru',
        'text7_az', 'text7_en', 'text7_ru',
        'text8_az', 'text8_en', 'text8_ru',
    ];
}