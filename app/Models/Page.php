<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'subtitle',
        'content',
        'excerpt',
        'banner_image',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'is_active',
        'order_index',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order_index' => 'integer',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->title);
            }
        });
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order_index');
    }

    public function getBannerUrlAttribute(): string
    {
        if (empty($this->banner_image)) {
            return asset('images/vedic-pattern-bg.jpg');
        }
        if (str_starts_with($this->banner_image, 'http://') || str_starts_with($this->banner_image, 'https://')) {
            return $this->banner_image;
        }
        if (file_exists(public_path('uploads/pages/' . $this->banner_image))) {
            return asset('uploads/pages/' . $this->banner_image);
        }
        if (file_exists(public_path('images/' . $this->banner_image))) {
            return asset('images/' . $this->banner_image);
        }
        return asset('images/vedic-pattern-bg.jpg');
    }
}
