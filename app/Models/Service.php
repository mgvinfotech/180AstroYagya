<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Service extends Model
{
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'title',
        'slug',
        'subtitle',
        'short_desc',
        'detailed_desc',
        'mantra_chanted',
        'duration',
        'priests_count',
        'dakshina_inr',
        'dakshina_usd',
        'benefits',
        'samagri_details',
        'image',
        'banner_image',
        'is_featured',
        'is_active',
        'order_index',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'benefits' => 'array',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'dakshina_inr' => 'decimal:2',
        'dakshina_usd' => 'decimal:2',
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

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order_index');
    }

    public function getPriceAttribute()
    {
        return $this->dakshina_inr ?? 0;
    }

    public function getShortDescriptionAttribute()
    {
        return strip_tags($this->short_desc ?: $this->detailed_desc);
    }

    public function getDescriptionAttribute()
    {
        return strip_tags($this->short_desc ?: $this->detailed_desc);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('is_active', true)->orderBy('order_index');
    }

    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('images/divine.jpg');
        }
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }
        if (file_exists(public_path('uploads/services/' . $this->image))) {
            return asset('uploads/services/' . $this->image);
        }
        if (file_exists(public_path('images/' . $this->image))) {
            return asset('images/' . $this->image);
        }
        if (file_exists(public_path($this->image))) {
            return asset($this->image);
        }
        return asset('images/divine.jpg');
    }
}
