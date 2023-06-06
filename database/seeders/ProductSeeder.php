<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

use App\Models\Product;
use App\Models\Color;
use App\Models\Size;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // For color
        $colors = Color::pluck('id')->toArray();
         $sizes = Size::pluck('id')->toArray();
        $faker = Faker::create();

        // Create 10 Products
       Product::factory()
            ->count(10)
            ->create()
            ->each(function ($product) use ($colors, $sizes, $faker) {
                // Attach random colors to the product
                $product->colors()->attach($this->getRandomColors($colors, $faker));

                // Attach random sizes to the product
                $product->sizes()->attach($this->getRandomSizes($sizes, $faker));
            });

        // Create 10 Product
        // Product::factory()->count(10)->create();
    }


    /**
     * Get a random selection of colors.
     *
     * @param array $colors
     * @return array
     */
    private function getRandomColors(array $colors, $faker): array
    {
        $randomColors = [];

        $count = rand(1, 3);
        for ($i = 0; $i < $count; $i++) {
            $color = $faker->randomElement($colors);

            // Ensure color is not repeated
            if (!in_array($color, $randomColors)) {
                $randomColors[] = $color;
            }
        }

        return $randomColors;
    }

    /**
     * Get a random selection of sizes.
     *
     * @param array $sizes
     * @return array
     */
    private function getRandomSizes(array $sizes, $faker): array
    {
        $randomSizes = [];

        $count = rand(1, 3);
        for ($i = 0; $i < $count; $i++) {
            $size = $faker->randomElement($sizes);

            // Ensure size is not repeated
            if (!in_array($size, $randomSizes)) {
                $randomSizes[] = $size;
            }
        }

        return $randomSizes;
    }
    

}
