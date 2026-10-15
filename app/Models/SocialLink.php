<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    protected $fillable = [
        'platform',
        'title',
        'url',
        'icon',
        'order_index',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];
}
