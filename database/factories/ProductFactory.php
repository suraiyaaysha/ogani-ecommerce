<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use Illuminate\Support\Str;
// use Illuminate\Support\Facades\Json;
use Illuminate\Support\Facades\Json;


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
            'discount' => $this->faker->randomFloat(2, 1, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'featured_image' => $this->faker->imageUrl(),
            // 'gallery_images' => [], // Modify as per your requirement
            // 'gallery_images' => serialize([]), // Serialize the array
            // 'gallery_images' => Json::encode([]), // Encode the array as JSON string
            'gallery_images' => json_encode([]),
            'weight' => $this->faker->randomFloat(2, 0.1, 100),
            'color' => $this->faker->colorName,
            'product_size' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL']),
            'shipping_duration' => $this->faker->numberBetween(1, 10),
            'shipping_charge' => $this->faker->randomFloat(2, 0, 50),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
