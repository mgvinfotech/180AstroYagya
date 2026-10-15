<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    protected $fillable = [
        'badge',
        'title',
        'subtitle',
        'description',
        'image',
        'btn_primary_text',
        'btn_primary_url',
        'btn_secondary_text',
        'btn_secondary_url',
        'order_index',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order_index');
    }

    public function getImageUrlAttribute(): string
    {
        if (empty($this->image)) {
            return asset('images/1.jpg');
        }
        if (str_starts_with($this->image, 'http://') || str_starts_with($this->image, 'https://')) {
            return $this->image;
        }
        if (file_exists(public_path('uploads/sliders/' . $this->image))) {
            return asset('uploads/sliders/' . $this->image);
        }
        if (file_exists(public_path('images/' . $this->image))) {
            return asset('images/' . $this->image);
        }
        if (file_exists(public_path($this->image))) {
            return asset($this->image);
        }
        return asset('images/1.jpg');
    }
}
