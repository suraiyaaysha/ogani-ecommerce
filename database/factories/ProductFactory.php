<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;

use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Product::class;

    public function definition(): array
    {

        $name = $this->faker->word;

        return [
            // 'category_id' => $category->id,
            
            // 'name' => $this->faker->word,
            // 'slug' => $this->faker->slug,
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence,
            'information' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'thumbnail' => $this->faker->imageUrl(),
            'weight' => $this->faker->randomFloat(2, 0.1, 100),
            'color' => $this->faker->colorName,
            'product_size' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL']),
        ];
    }
}
