<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notice extends Model
{
    protected $fillable = [
        'title',
        'title_bn',
        'title_en',
        'description',
        'description_bn',
        'description_en',
        'category',
        'notice_date',
        'file',
        'status',
        'is_delete',
    ];

    protected $casts = [
        'notice_date' => 'date',
        'status' => 'boolean',
        'is_delete' => 'boolean',
    ];

    public function getTitleAttribute()
    {
        if (app()->getLocale() === 'en' && !empty($this->attributes['title_en'])) {
            return $this->attributes['title_en'];
        }
        return $this->attributes['title_bn'] ?? $this->attributes['title'] ?? '';
    }

    public function getDescriptionAttribute()
    {
        if (app()->getLocale() === 'en' && !empty($this->attributes['description_en'])) {
            return $this->attributes['description_en'];
        }
        return $this->attributes['description_bn'] ?? $this->attributes['description'] ?? '';
    }
}