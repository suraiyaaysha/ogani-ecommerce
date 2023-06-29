<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Cms;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cms::create([
            'site_logo' => 'frontend/assets/img/logo.png',
            'site_email' => 'info@example.com',
            'site_mobile' => '1234567890',
            'site_support_text' => 'upport 24/7 time',
            'site_address' => '60-49 Road 11378 New York',
            'free_shipping_text' => 'Free Shipping for all Order of $99',
            'facebook_url' => 'https://www.facebook.com',
            'twitter_url' => 'https://www.twitter.com',
            'linkedin_url' => 'https://www.linkedin.com',
            'pinterest_url' => 'https://www.pinterest.com',
            'newsletter_text' => 'Get E-mail updates about our latest shop and special offers.',
            'copyright_text' => 'All rights reserved | This template is made with  by Colorlib',
            'payment_method_img' => 'frontend/assets/img/payment-item.png',
            'business_open_time' => '10:00 am to 23:00 pm',
            'google_map_url' => 'https://www.google.com',
            'banner_category_name' => 'Vegetables',
            'banner_title' => 'Vegetable 100% Organic',
            'banner_text' => 'Free Pickup and Delivery Available',
            // 'banner_shop_url' => 'http://127.0.0.1:8000/category/vegetables',
            'banner_img' => 'frontend/assets/img/hero/banner.jpg',
        ]);
    }
}
