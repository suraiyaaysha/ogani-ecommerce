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

        // $product = Product::inRandomOrder()->first(); //Get a random category
        $user = User::inRandomOrder()->first(); //Get a random user_id

         return [
            'order_number' => $this->faker->unique()->randomNumber(6),
            'user_id' => $user->id,
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed']),
            'grand_total' => $this->faker->randomFloat(2, 100, 1000),
            'item_count' => $this->faker->numberBetween(1, 10),
            'payment_status' => $this->faker->randomElement(['paid', 'unpaid']),
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal']),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'phone' => $this->faker->phoneNumber,
            'country' => $this->faker->country,
            'address_1' => $this->faker->streetAddress,
            'address_2' => $this->faker->secondaryAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zip' => $this->faker->postcode,
            'notes' => $this->faker->text,
        ];
    }
}
