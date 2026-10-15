<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'type',
        'icon',
        'short_desc',
        'image',
        'order_index',
        'is_active',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_active' => 'boolean',
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

    public function subcategories(): HasMany
    {
        return $this->hasMany(Subcategory::class)->orderBy('order_index');
    }

    public function services(): HasMany
    {
        return $this->hasMany(Service::class)->orderBy('order_index');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('order_index');
    }
}
