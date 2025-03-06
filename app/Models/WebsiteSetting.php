<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'web_name',
        'web_logo',
        'web_favicon',
        'web_description',
        'web_meta_title',
        'web_meta_keywords',
        'web_meta_description',
        'web_google_analytics',
        'web_facebook_pixel',
        'web_header_script',
        'web_footer_script',
        'web_og_image',
        'web_status'
    ];
    
}
