<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdmissionApplication extends Model
{
    protected $fillable = [
        'application_no',
        'academic_year',
        'student_name',
        'student_name_bn',
        'student_name_en',
        'date_of_birth',
        'gender',
        'class',
        'group_name',
        'blood_group',
        'birth_reg_no',
        'religion',
        'nationality',
        'previous_school',
        'father_name',
        'father_name_en',
        'father_nid',
        'father_education',
        'mother_name',
        'mother_name_en',
        'mother_nid',
        'mother_education',
        'guardian_phone',
        'contact_mobile',
        'email',
        'address',
        'permanent_address',
        'present_address',
        'guardian_info',
        'father_occupation_info',
        'other_children_info',
        'student_photo',
        'birth_certificate',
        'status',
        'admin_note',
        'is_lottery_selected',
        'lottery_rank',
        'lottery_quota',
        'lottery_drawn_at',
        'is_confirmed',
        'confirmed_at',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'is_lottery_selected' => 'boolean',
        'is_confirmed' => 'boolean',
        'lottery_drawn_at' => 'datetime',
        'confirmed_at' => 'datetime',
    ];

    public function payments()
    {
        return $this->hasMany(
            AdmissionPayment::class,
            'admission_application_id'
        );
    }

    public function approvedPayment()
    {
        return $this->hasOne(
            AdmissionPayment::class,
            'admission_application_id'
        )->where('status', 'approved');
    }
}