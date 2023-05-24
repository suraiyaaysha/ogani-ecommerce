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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->longText('description');
            $table->longText('information');
            $table->decimal('price', 8, 2);
            $table->integer('quantity');
            $table->string('featured_image');
            $table->json('gallery_images')->nullable();
            $table->decimal('weight', 8, 2);
            $table->string('color');
            $table->string('product_size');
            $table->decimal('shipping_duration', 8, 2);
            $table->decimal('shipping_charge', 8, 2);
            $table->enum('status', ['active', 'inactive'])->default('active');
            // $table->string('product_category_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
