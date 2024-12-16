<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $fillable = [
        'image',
        'text_az',
        'text_en',
        'text_ru',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    public function getTextAttribute()
    {
        return $this->{'text_' . app()->getLocale()};
    }
}
