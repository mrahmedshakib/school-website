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
        'developer_name',
        'developer_name_en',
        'developer_username',
        'developer_role',
        'developer_organization',
        'developer_email',
        'developer_phone',
        'developer_whatsapp',
        'developer_photo',
        'developer_portfolio',
        'developer_github',
        'developer_linkedin',
        'developer_whatsapp_message',
        'developer_contact_note',
    ];
}