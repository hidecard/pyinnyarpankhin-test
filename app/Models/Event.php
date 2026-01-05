<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'description',
        'event_date',
        'event_time',
        'location',
        'image',
        'is_active',
    ];

    protected $casts = [
        'event_date' => 'date',
        'event_time' => 'datetime:H:i',
        'is_active' => 'boolean',
    ];
}
