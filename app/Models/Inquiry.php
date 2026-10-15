<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inquiry extends Model
{
    protected $fillable = [
        'inquiry_type',
        'service_id',
        'astrologer_id',
        'full_name',
        'email',
        'phone',
        'whatsapp',
        'date_of_birth',
        'time_of_birth',
        'place_of_birth',
        'gotra',
        'rashi_nakshatra',
        'preferred_language',
        'preferred_date',
        'problem_description',
        'status',
        'admin_notes',
        'email_sent',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'preferred_date' => 'date',
        'email_sent' => 'boolean',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }

    public function astrologer(): BelongsTo
    {
        return $this->belongsTo(Astrologer::class);
    }
}
