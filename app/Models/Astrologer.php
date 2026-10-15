<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Astrologer extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'title',
        'qualification',
        'experience_years',
        'specialties',
        'languages',
        'bio',
        'avatar',
        'rating',
        'reviews_count',
        'consultation_fee',
        'is_available_online',
        'is_featured',
        'is_active',
        'order_index',
    ];

    protected $casts = [
        'is_available_online' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'rating' => 'decimal:2',
        'consultation_fee' => 'decimal:2',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function inquiries(): HasMany
    {
        return $this->hasMany(Inquiry::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order_index');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)->where('is_active', true)->orderBy('order_index');
    }

    public function getAvatarUrlAttribute(): string
    {
        $img = $this->avatar ?: ($this->attributes['photo'] ?? null);
        if (empty($img)) {
            return asset('images/panditji.jpg');
        }
        if (str_starts_with($img, 'http://') || str_starts_with($img, 'https://')) {
            return $img;
        }
        if (file_exists(public_path('uploads/astrologers/' . $img))) {
            return asset('uploads/astrologers/' . $img);
        }
        if (file_exists(public_path('images/' . $img))) {
            return asset('images/' . $img);
        }
        if (file_exists(public_path($img))) {
            return asset($img);
        }
        return asset('images/panditji.jpg');
    }

    public function getPhotoUrlAttribute(): string
    {
        return $this->avatar_url;
    }
}
