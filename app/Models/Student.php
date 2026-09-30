<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'student_id',
        'name_bn',
        'name_en',
        'class',
        'section',
        'roll_no',
        'gender',
        'academic_year',
        'guardian_name_bn',
        'guardian_name_en',
        'guardian_phone',
        'blood_group',
        'photo',
        'status',
        'sort_order',
    ];

    public function getNameAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->name_en)) ? $this->name_en : $this->name_bn;
    }

    public function getGuardianNameAttribute()
    {
        return (app()->getLocale() === 'en' && !empty($this->guardian_name_en)) ? $this->guardian_name_en : $this->guardian_name_bn;
    }
}
