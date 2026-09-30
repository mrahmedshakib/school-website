<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $fillable = [
        'school_name',
        'school_name_bn',
        'tagline',
        'logo',
        'favicon',
        'address',
        'phone',
        'mobile',
        'email',
        'website',
        'facebook',
        'youtube',
        'twitter',
        'linkedin',
        'footer_text',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];
}