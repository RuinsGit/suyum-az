<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'name_az',
        'name_en',
        'name_ru',
        'cartridge_az',
        'cartridge_en',
        'cartridge_ru',
        'pressure_range_az',
        'pressure_range_en',
        'pressure_range_ru',
        'temperature_range_az',
        'temperature_range_en',
        'temperature_range_ru',
        'dimensions_az',
        'dimensions_en',
        'dimensions_ru',
        'warranty_az',
        'warranty_en',
        'warranty_ru',
        'country_az',
        'country_en',
        'country_ru',
        'price',
        'annual_percentage',
        'installment_months',
        'has_courier',
        'courier_price',
        'has_installation',
        'installation_price',
        'main_image',
        'courier_image',
        'installation_image',
        'payment_image_1',
        'payment_image_2',
        'status'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'monthly_percentage' => 'decimal:2',
        'courier_price' => 'decimal:2',
        'installation_price' => 'decimal:2',
        'has_courier' => 'boolean',
        'has_installation' => 'boolean',
        'status' => 'boolean'
    ];

    // Taksit hesaplama metodu
    public function calculateInstallment($months)
    {
        if ($months <= 0) {
            return $this->price;
        }

        // Aylıq faiz ilə yeni qiyməti hesabla
        $totalPercentage = $this->monthly_percentage * $months;
        $totalPrice = $this->price * (1 + ($totalPercentage / 100));
        
        return [
            'total_price' => round($totalPrice, 2),
            'monthly_payment' => round($totalPrice / $months, 2),
            'difference' => round($totalPrice - $this->price, 2)
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getInstallmentOptions()
    {
        if (empty($this->installment_months)) {
            return [];
        }

        $months = explode(',', $this->installment_months);
        $options = [];

        foreach ($months as $month) {
            $calculation = $this->calculateInstallment((int)$month);
            $options[$month] = [
                'total_price' => $calculation['total_price'],
                'monthly_payment' => $calculation['monthly_payment'],
                'difference' => $calculation['difference']
            ];
        }

        return $options;
    }
} 