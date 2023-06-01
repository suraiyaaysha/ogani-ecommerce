<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Blog::class;

    public function definition(): array
    {

        $title = $this->faker->sentence;

        // Get a random blog category
        $blogCategory = BlogCategory::inRandomOrder()->first();

        return [
            'user_id' => User::where('email', 'admin@gmail.com')->first()->id, //Only Admin Can create posts
            // 'blog_category_id' => BlogCategory::factory()->create()->id,
            'blog_category_id' => $blogCategory->id,

            'title' => $title,
            'slug' => Str::slug($title),
            'details' => $this->faker->paragraph,
            'thumbnail' => $this->faker->imageUrl(),
        ];
    }
}
