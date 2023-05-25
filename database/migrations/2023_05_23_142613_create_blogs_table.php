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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->longText('details');
            $table->string('thumbnail');

            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('blog_category_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('blog_category_id')->references('id')->on('blog_categories')->onDelete('cascade');

            $table->timestamps();
        });

        Schema::create('comments', function (Blueprint $table) {
            $table->id();

            $table->text('body');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('blog_id')->constrained();
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
        Schema::dropIfExists('blogs');
    }
};
