<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Tag;
use Illuminate\Support\Str;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Tag::class;

    public function definition(): array
    {
        // $name = $this->faker->word;
        // $slug = Str::slug($name, '-');

        $name = $this->faker->unique()->word;
        $slug = Str::slug($name, '-');

        return [
            'name' => $name,
            'slug' => $slug,
        ];
    }
}
