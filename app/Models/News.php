<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'image',
        'published_at',
        'sort_order',
        'status',
        'is_delete',
    ];

    protected $casts = [
        'published_at' => 'date',
        'status' => 'boolean',
        'is_delete' => 'boolean',
    ];
}