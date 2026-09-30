<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRoutine extends Model
{
    protected $fillable = [
        'title_bn',
        'title_en',
        'class',
        'section',
        'shift',
        'academic_year',
        'file_path',
        'status',
        'sort_order',
    ];

    public function getTitleAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->title_en)) ? $this->title_en : $this->title_bn;
    }
}
