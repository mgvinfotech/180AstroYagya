<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NavigationMenu extends Model
{
    protected $fillable = [
        'title',
        'url',
        'parent_id',
        'location',
        'target',
        'badge',
        'order_index',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(NavigationMenu::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(NavigationMenu::class, 'parent_id')->orderBy('order_index');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
