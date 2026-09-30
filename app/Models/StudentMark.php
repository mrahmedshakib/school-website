<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    protected $fillable = [
        'exam_name_bn',
        'exam_name_en',
        'academic_year',
        'class',
        'section',
        'roll_no',
        'student_id',
        'student_name_bn',
        'student_name_en',
        'gpa',
        'grade',
        'total_marks',
        'result_status',
        'marks_details',
        'remarks',
    ];

    protected $casts = [
        'marks_details' => 'array',
        'gpa' => 'decimal:2',
    ];

    public function getStudentNameAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->student_name_en)) ? $this->student_name_en : $this->student_name_bn;
    }

    public function getExamNameAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->exam_name_en)) ? $this->exam_name_en : $this->exam_name_bn;
    }

    public function getLetterGradeAttribute()
    {
        return $this->grade;
    }

    public function getStatusAttribute()
    {
        return $this->result_status;
    }
}
