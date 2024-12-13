<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'image',
        'link',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}