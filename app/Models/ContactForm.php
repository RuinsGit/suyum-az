<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactForm extends Model
{
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'message',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}