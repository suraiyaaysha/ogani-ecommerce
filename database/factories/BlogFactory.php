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

        $blog_category_id = BlogCategory::inRandomOrder()->first(); //Get a random category
        $user = User::inRandomOrder()->first(); //Get a random user_id


        $title = $this->faker->sentence;

        return [
            'user_id' => User::where('email', 'admin@gmail.com')->first()->id, //Only Admin Can create posts
            'blog_category_id' => BlogCategory::factory()->create()->id,

            'title' => $title,
            'slug' => Str::slug($title),
            'details' => $this->faker->sentence,
            'thumbnail' => $this->faker->imageUrl(),
        ];
    }
}
