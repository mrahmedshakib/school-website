<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    protected $fillable = [
        'title_bn',
        'title_en',
        'youtube_url',
        'video_id',
        'category_bn',
        'category_en',
        'thumbnail',
        'description_bn',
        'description_en',
        'status',
        'sort_order',
    ];

    public function getTitleAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->title_en)) ? $this->title_en : $this->title_bn;
    }

    public function getCategoryAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->category_en)) ? $this->category_en : $this->category_bn;
    }

    public function getDescriptionAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->description_en)) ? $this->description_en : $this->description_bn;
    }
}
