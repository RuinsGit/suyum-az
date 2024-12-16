<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;

    protected $fillable = [
        'home_az', 'home_en', 'home_ru',
        'about_az', 'about_en', 'about_ru',
        'products_az', 'products_en', 'products_ru',
        'services_az', 'services_en', 'services_ru',
        'projects_az', 'projects_en', 'projects_ru',
        'certificates_az', 'certificates_en', 'certificates_ru',
        'customers_az', 'customers_en', 'customers_ru',
        'contact_az', 'contact_en', 'contact_ru',
        'status'
    ];

    public function getHomeAttribute()
    {
        return $this->{'home_' . app()->getLocale()};
    }

    public function getAboutAttribute()
    {
        return $this->{'about_' . app()->getLocale()};
    }

    public function getProductsAttribute()
    {
        return $this->{'products_' . app()->getLocale()};
    }

    public function getServicesAttribute()
    {
        return $this->{'services_' . app()->getLocale()};
    }

    public function getProjectsAttribute()
    {
        return $this->{'projects_' . app()->getLocale()};
    }

    public function getCertificatesAttribute()
    {
        return $this->{'certificates_' . app()->getLocale()};
    }

    public function getCustomersAttribute()
    {
        return $this->{'customers_' . app()->getLocale()};
    }

    public function getContactAttribute()
    {
        return $this->{'contact_' . app()->getLocale()};
    }       
}
