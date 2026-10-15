<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'client_name',
        'client_title',
        'location',
        'service_taken',
        'service_name',
        'rating',
        'review_text',
        'avatar',
        'video_url',
        'is_verified',
        'is_featured',
        'order_index',
        'is_active',
    ];

    public function getServiceTakenAttribute($value)
    {
        return $value ?: ($this->attributes['service_name'] ?? '');
    }

    protected $casts = [
        'is_verified' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

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
        if (empty($this->avatar)) {
            return asset('images/t1.png');
        }
        if (str_starts_with($this->avatar, 'http://') || str_starts_with($this->avatar, 'https://')) {
            return $this->avatar;
        }
        if (file_exists(public_path('uploads/testimonials/' . $this->avatar))) {
            return asset('uploads/testimonials/' . $this->avatar);
        }
        if (file_exists(public_path('images/' . $this->avatar))) {
            return asset('images/' . $this->avatar);
        }
        if (file_exists(public_path($this->avatar))) {
            return asset($this->avatar);
        }
        return asset('images/t1.png');
    }
}
