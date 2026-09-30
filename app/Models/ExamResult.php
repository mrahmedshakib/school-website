<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    protected $fillable = [
        'title_bn',
        'title_en',
        'exam_name_bn',
        'exam_name_en',
        'class',
        'academic_year',
        'publish_date',
        'file_path',
        'total_students',
        'passed_students',
        'failed_students',
        'gpa5_count',
        'pass_rate',
        'status',
        'sort_order',
    ];

    protected $casts = [
        'publish_date' => 'date',
        'pass_rate' => 'decimal:2',
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
