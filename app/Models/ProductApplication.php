<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'message',
        'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}