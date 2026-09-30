<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolPublication extends Model
{
    protected $fillable = [
        'type',
        'title_bn',
        'title_en',
        'edition_bn',
        'edition_en',
        'publish_date',
        'academic_year',
        'cover_image',
        'file_path',
        'description_bn',
        'description_en',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'publish_date' => 'date',
    ];

    public function getTitleAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->title_en)) ? $this->title_en : $this->title_bn;
    }

    public function getEditionAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->edition_en)) ? $this->edition_en : $this->edition_bn;
    }

    public function getDescriptionAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->description_en)) ? $this->description_en : $this->description_bn;
    }
}
