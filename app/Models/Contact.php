<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_az', 'number_az', 'address_az', 'email_az',
        'name_en', 'number_en', 'address_en', 'email_en',
        'name_ru', 'number_ru', 'address_ru', 'email_ru',
        'filial_name_az', 'filial_name_en', 'filial_name_ru',
        'number_image', 'address_image', 'email_image',
        'filial_text_az', 'filial_text_en', 'filial_text_ru',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];

    // Dil özelliklerine göre accessor'lar
    public function getNameAttribute()
    {
        return $this->{'name_' . app()->getLocale()};
    }

    public function getNumberAttribute()
    {
        return $this->{'number_' . app()->getLocale()};
    }

    public function getAddressAttribute()
    {
        return $this->{'address_' . app()->getLocale()};
    }

    public function getEmailAttribute()
    {
        return $this->{'email_' . app()->getLocale()};
    }

    public function getFilialTextAttribute()
    {
        return $this->{'filial_text_' . app()->getLocale()};
    }
}
