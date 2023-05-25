<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Order;
use App\Models\User;
use App\Models\Product;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Order::class;

    public function definition(): array
    {

        $product = Product::inRandomOrder()->first(); //Get a random category
        $user = User::inRandomOrder()->first(); //Get a random user_id

        return [
            'user_id' => $user->id,
            'product_id' => $product->id,

            // 'user_id' => $this->faker->numberBetween(1, 10),
            // 'product_id' => $this->faker->numberBetween(1, 10),
            'quantity' => $this->faker->numberBetween(1, 10),
            'total_price' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
