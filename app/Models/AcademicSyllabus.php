<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AcademicSyllabus extends Model
{
    protected $table = 'academic_syllabuses';

    protected $fillable = [
        'title_bn',
        'title_en',
        'class',
        'academic_year',
        'subject_name_bn',
        'subject_name_en',
        'file_path',
        'description_bn',
        'description_en',
        'status',
        'sort_order',
    ];

    public function getTitleAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->title_en)) ? $this->title_en : $this->title_bn;
    }

    public function getSubjectNameAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->subject_name_en)) ? $this->subject_name_en : $this->subject_name_bn;
    }

    public function getDescriptionAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->description_en)) ? $this->description_en : $this->description_bn;
    }
}
