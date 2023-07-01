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
            'site_country' => 'New York',
            'free_shipping_text' => 'Free Shipping for all Order of $99',
            'facebook_url' => 'https://www.facebook.com',
            'twitter_url' => 'https://www.twitter.com',
            'linkedin_url' => 'https://www.linkedin.com',
            'pinterest_url' => 'https://www.pinterest.com',
            'newsletter_text' => 'Get E-mail updates about our latest shop and special offers.',
            'copyright_text' => 'All rights reserved | This template is made with  by Colorlib',
            'payment_method_img' => 'frontend/assets/img/payment-item.png',
            'business_open_time' => '10:00 am to 23:00 pm',
            'google_map_url' => 'https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d235215.58200312319!2d89.3944127!3d22.904389!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39ff9071cb47152f%3A0xf04b212290718952!2sKhulna!5e0!3m2!1sen!2sbd!4v1688195509554!5m2!1sen!2sbd',
            'banner_category_name' => 'Vegetables',
            'banner_title' => 'Vegetable 100% <br> Organic',
            'banner_text' => 'Free Pickup and Delivery Available',
            // 'banner_shop_url' => 'http://127.0.0.1:8000/category/vegetables',
            'banner_shop_url' => 'vegetables',
            'banner_img' => 'frontend/assets/img/hero/banner.jpg',

            'page_banner_img' => 'frontend/assets/img/breadcrumb.jpg',

            'category_banner_name1' =>'Fruit & Nut Gifts',
            'category_banner_slug1' => 'fruit-&-nut-gifts',
            'category_banner_img1' => 'frontend/assets/img/banner/banner-1.jpg',

            'category_banner_name2' => 'Fresh Meat',
            'category_banner_slug2' => 'fresh-meat',
            'category_banner_img2' => 'frontend/assets/img/banner/banner-2.jpg',
        ]);
    }
}
