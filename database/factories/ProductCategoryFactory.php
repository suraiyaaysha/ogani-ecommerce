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
            'thumbnail' => $this->getRandomLocalImage(),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'is_featured' => $this->faker->boolean(),
        ];
    }

        /**
     * Get a random image URL from the storage.
     */
    private function getRandomLocalImage()
    {
        // Generate a random number between 1 and 12
        $randomNumber = rand(1, 5);

        // Construct the file name using the random number
        $fileName = "cat-$randomNumber.jpg";

        // Return the file URL relative to the public directory
        return "frontend/assets/img/categories/$fileName";
    }
}
