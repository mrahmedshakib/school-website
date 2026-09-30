<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admission extends Model
{
    protected $fillable = [
        'title',
        'description',
        'image',
        'pdf',
        'application_start',
        'application_end',
        'application_url',
        'sort_order',
        'status',
        'is_delete',
    ];

    protected $casts = [
        'application_start' => 'date',
        'application_end' => 'date',
        'status' => 'boolean',
        'is_delete' => 'boolean',
    ];
}