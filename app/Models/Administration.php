<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administration extends Model
{
    protected $fillable = [
        'name',
        'designation',
        'phone',
        'email',
        'description',
        'image',
        'sort_order',
        'status',
        'is_delete',
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_delete' => 'boolean',
    ];
}