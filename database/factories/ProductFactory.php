<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

use App\Models\Product;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\Color;
use App\Models\Size;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->word;

        // Get a random product category
        $productCategory = ProductCategory::inRandomOrder()->first();

        // Get random colors and sizes
        $colors = Color::inRandomOrder()->limit(rand(1, 3))->pluck('id')->toArray();
        $sizes = Size::inRandomOrder()->limit(rand(1, 3))->pluck('id')->toArray();

        return [
            'user_id' => User::where('email', 'admin@gmail.com')->first()->id,
            'product_category_id' => $productCategory->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence,
            'information' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 1, 1000),
            'discount' => $this->faker->randomFloat(2, 1, 1000),
            'quantity' => $this->faker->numberBetween(1, 100),
            'featured_image' => $this->faker->imageUrl(),
            'gallery_images' => json_encode([]),
            'weight' => $this->faker->randomFloat(2, 0.1, 100),
            // 'color' => $this->faker->colorName,
            // 'product_size' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL']),
            'shipping_duration' => $this->faker->numberBetween(1, 10),
            'shipping_charge' => $this->faker->randomFloat(2, 0, 50),
            'is_featured' => rand(0, 1),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
