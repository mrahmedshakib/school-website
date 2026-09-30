<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamRoutine extends Model
{
    protected $fillable = [
        'title_bn',
        'title_en',
        'exam_name_bn',
        'exam_name_en',
        'class',
        'academic_year',
        'start_date',
        'end_date',
        'file_path',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function getTitleAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->title_en)) ? $this->title_en : $this->title_bn;
    }

    public function getExamNameAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->exam_name_en)) ? $this->exam_name_en : $this->exam_name_bn;
    }
}
