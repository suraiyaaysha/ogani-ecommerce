<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Color;
use Illuminate\Support\Str;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Color::factory()->count(10)->create();
        $colors = ['White', 'Gray', 'Red', 'Black', 'Blue', 'Green'];

        foreach ($colors as $color) {
            Color::firstOrCreate(['slug' => Str::slug($color)], ['name' => $color]);
        }
    }
}
