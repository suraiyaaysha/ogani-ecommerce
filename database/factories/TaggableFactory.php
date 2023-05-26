<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\Taggable;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Taggable>
 */
class TaggableFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    
    protected $model = Taggable::class;

    public function definition(): array
    {
        return [
            //
        ];
    }
}
