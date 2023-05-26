<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'email' => $this->faker->unique()->safeEmail(),
            'message' => $this->faker->paragraph,
            // 'user_id' => \App\Models\User::factory(), // Assuming you have a User model and a UserFactory
        ];
    }
}
