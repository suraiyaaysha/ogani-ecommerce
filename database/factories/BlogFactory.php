<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

use App\Models\Blog;

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

        return [
            // 'blog_category_id' => $blog_category_id->id,

            'title' => $title,
            'slug' => Str::slug($title),
            'details' => $this->faker->sentence,
            'thumbnail' => $this->faker->imageUrl(),
        ];
    }
}
