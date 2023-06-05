<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Size;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Size>
 */
class SizeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Size::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL']),
            'slug' => Str::slug($this->faker->randomElement(['XS', 'S', 'M', 'L', 'XL'])),
        ];
    }
}
