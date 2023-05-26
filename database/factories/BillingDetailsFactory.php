<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BillingDetails;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\BillingDetails>
 */
class BillingDetailsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BillingDetails::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $user = User::inRandomOrder()->first();

        return [
            // 'user_id' => function () {
            //     return \App\Models\User::factory()->create()->id;
            // },
            // 'user_id' => User::factory()->create()->id,
            // 'user_id' => \App\Models\User::factory()->create()->id,


            'user_id' => $user->id,

            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'state' => $this->faker->state,
            'zip' => $this->faker->postcode,
        ];
    }
}
