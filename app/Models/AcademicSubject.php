<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicSubject extends Model
{
    protected $fillable = [
        'name_bn',
        'name_en',
        'code',
        'class',
        'group_name',
        'type',
        'total_marks',
        'theory_marks',
        'practical_marks',
        'viva_marks',
        'description_bn',
        'description_en',
        'status',
        'sort_order',
    ];

    public function getNameAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->name_en)) ? $this->name_en : $this->name_bn;
    }

    public function getDescriptionAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->description_en)) ? $this->description_en : $this->description_bn;
    }

    public function getSubjectCodeAttribute()
    {
        return $this->code;
    }

    public function getSubjectTypeAttribute()
    {
        return $this->type;
    }
}
