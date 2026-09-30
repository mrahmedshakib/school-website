<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'image',
        'event_date',
        'event_time',
        'location',
        'sort_order',
        'status',
        'is_delete',
    ];

    protected $casts = [
        'event_date' => 'date',
        'status' => 'boolean',
        'is_delete' => 'boolean',
    ];
}