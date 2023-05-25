<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\User;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product = Product::inRandomOrder()->first();
        $user = User::inRandomOrder()->first();

        return [
            'product_id' => $product->id,
            'user_id' => $user->id,
            'parent_id' => null,

            'body' => $this->faker->sentence,
        ];
    }
}
