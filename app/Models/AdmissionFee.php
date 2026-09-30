<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionFee extends Model
{
    protected $fillable = [
        'name',
        'amount',
        'description',
        'sort_order',
        'status',
        'is_delete',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'status' => 'boolean',
        'is_delete' => 'boolean',
    ];
}