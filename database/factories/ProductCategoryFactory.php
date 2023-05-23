<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

use App\Models\ProductCategory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = ProductCategory::class;

    public function definition(): array
    {
        
        $name = $this->faker->word;

        return [
            'name' => $name,
            'slug' => Str::slug($name),
            // 'thumbnail' => $this->faker->imageUrl(),
        ];
    }
}
