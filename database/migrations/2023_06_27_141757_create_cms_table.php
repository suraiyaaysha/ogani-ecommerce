<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cms', function (Blueprint $table) {
            $table->id();

            $table->string('site_logo')->nullable();
            $table->string('site_email');
            $table->string('site_mobile');
            $table->text('site_support_text');
            $table->longText('site_address');
            $table->text('site_country');
            $table->text('free_shipping_text');
            $table->string('facebook_url');
            $table->string('twitter_url');
            $table->string('linkedin_url');
            $table->string('pinterest_url');
            $table->text('newsletter_text');
            $table->text('copyright_text');
            $table->string('payment_method_img')->nullable();
            $table->string('business_open_time');
            $table->text('google_map_url');
            $table->text('banner_category_name');
            $table->text('banner_title');
            $table->text('banner_text');
            // $table->string('banner_shop_url')->nullable();
            $table->string('banner_img')->nullable();
            $table->string('page_banner_img')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cms');
    }
};
