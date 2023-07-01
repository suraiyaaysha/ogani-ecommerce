<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_logo',
        'site_email',
        'site_mobile',
        'site_support_text',
        'site_address',
        'site_country',
        'free_shipping_text',
        'facebook_url',
        'twitter_url',
        'linkedin_url',
        'pinterest_url',
        'newsletter_text',
        'copyright_text',
        'payment_method_img',
        'business_open_time',
        'google_map_url',

        'banner_category_name',
        'banner_title',
        'banner_text',
        // 'banner_shop_url',
        'banner_img',
        'page_banner_img'
    ];
}
