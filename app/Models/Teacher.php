<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $fillable = [
        'name',
        'name_bn',
        'name_en',
        'type',
        'designation',
        'designation_bn',
        'designation_en',
        'subject',
        'subject_bn',
        'subject_en',
        'qualification_bn',
        'qualification_en',
        'phone',
        'email',
        'image',
        'sort_order',
        'status',
        'is_delete',
    ];

    protected $casts = [
        'status' => 'boolean',
        'is_delete' => 'boolean',
    ];

    public function getNameAttribute()
    {
        if (app()->getLocale() === 'en' && !empty($this->attributes['name_en'])) {
            return $this->attributes['name_en'];
        }
        return $this->attributes['name_bn'] ?? $this->attributes['name'] ?? '';
    }

    public function getDesignationAttribute()
    {
        if (app()->getLocale() === 'en' && !empty($this->attributes['designation_en'])) {
            return $this->attributes['designation_en'];
        }
        return $this->attributes['designation_bn'] ?? $this->attributes['designation'] ?? '';
    }

    public function getSubjectAttribute()
    {
        if (app()->getLocale() === 'en' && !empty($this->attributes['subject_en'])) {
            return $this->attributes['subject_en'];
        }
        return $this->attributes['subject_bn'] ?? $this->attributes['subject'] ?? '';
    }

    public function getQualificationAttribute()
    {
        if (app()->getLocale() === 'en' && !empty($this->attributes['qualification_en'])) {
            return $this->attributes['qualification_en'];
        }
        return $this->attributes['qualification_bn'] ?? '';
    }
}