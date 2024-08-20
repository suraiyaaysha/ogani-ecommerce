<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Product;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
// use App\Models\Color;
// use App\Models\Size;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $name = $this->faker->word;

        // Get a random product category
        $productCategory = ProductCategory::inRandomOrder()->first();

        // Get random colors and sizes
        // $colors = Color::inRandomOrder()->limit(rand(1, 3))->pluck('id')->toArray();
        // $sizes = Size::inRandomOrder()->limit(rand(1, 3))->pluck('id')->toArray();

        // For adding images on gallery images
        $hasGalleryImages = $this->faker->boolean;

        $galleryImages = [];
        if ($hasGalleryImages) {
            $galleryImages = [
                $this->faker->imageUrl(),
                $this->faker->imageUrl(),
                $this->faker->imageUrl(),
                // $this->getRandomImage(),
                // $this->getRandomImage(),
                // $this->getRandomImage(),
            ];
        }

        $price = $this->faker->numberBetween(1, 1000);
        $discount = $this->faker->numberBetween(1, min($price, 100));

        // Convert price and discount to integers
        $price = intval($price);
        $discount = intval($discount);

        return [
            'user_id' => User::where('email', 'admin@gmail.com')->first()->id,
            'product_category_id' => $productCategory->id,
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => $this->faker->sentence,
            'information' => $this->faker->sentence,
            // 'price' => $this->faker->randomFloat(2, 1, 1000),
            'price' => $price,
            // 'discount' => $this->faker->randomFloat(2, 1, 1000),
            'discount' => $discount,
            'quantity' => $this->faker->numberBetween(1, 100),
            'featured_image' => $this->faker->imageUrl(),
            // 'featured_image' => $this->getRandomImage(),
            // 'gallery_images' => json_encode([]),
             'gallery_images' => json_encode($galleryImages),

            'weight' => $this->faker->randomFloat(2, 0.1, 100),
            'shipping_duration' => $this->faker->numberBetween(1, 10),
            'shipping_charge' => $this->faker->randomFloat(2, 0, 50),
            'is_featured' => rand(0, 1),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            // 'sizes' => $sizes, // Attach random sizes to the product
        ];
    }

    /**
     * Get a random image URL from the storage.
     */
    private function getRandomImage()
    {
        // Directory where the images are stored
        $directory = public_path('frontend/assets/img/product');

        // Get all files from the directory
        $files = File::files($directory);

        // Pick a random file
        $randomFile = $this->faker->randomElement($files);

        // Return the file URL relative to the public directory
        return 'frontend/assets/img/product/' . $randomFile->getFilename();



                // // Generate a random number between 1 and 12
                // $randomNumber = rand(1, 12);

                // // Construct the file name using the random number
                // $fileName = "product-$randomNumber.jpg";
        
                // // Return the file URL relative to the public directory
                // return "frontend/assets/img/product/$fileName";
    }

}
