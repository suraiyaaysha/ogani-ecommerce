<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

use App\Models\BlogCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class BlogCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = BlogCategory::class;

    public function definition(): array
    {

        $name = $this->faker->word;

        return [
            // 'blog_id' => $blog_id->id,

            'name' => $name,
            'slug' => Str::slug($name),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
