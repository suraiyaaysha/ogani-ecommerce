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
            // $table->decimal('price', 8, 2);
            // $table->decimal('discount', 8, 2);

             $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('discount')->default(0);

            $table->integer('quantity');
            $table->string('featured_image');
            $table->json('gallery_images')->nullable();
            $table->decimal('weight', 8, 2);
            // $table->string('color');
            // $table->string('product_size');
            $table->decimal('shipping_duration', 8, 2);
            $table->decimal('shipping_charge', 8, 2);
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('product_category_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_category_id')->references('id')->on('product_categories')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->text('body');
            $table->integer('star_rating');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('product_id')->constrained();
            $table->integer('parent_id')->unsigned()->nullable();

            $table->timestamps();
            $table->softDeletes();
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
