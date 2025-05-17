<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    //
    protected $table = 'site_settings';
    protected $fillable = [
        'shop_name',
        'logo_path',
        'shop_email',
        'slogan',
        'about_us',
        'phone',
        'address',
        'facebook_name',
        'facebook_link',
        'twitter_name',
        'twitter_link',
        'instagram_name',
        'instagram_link'
    ];
}
