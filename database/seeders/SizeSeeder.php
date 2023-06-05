<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Size;
use Illuminate\Support\Str;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Size::factory()->count(10)->create();

        $sizes = ['Large', 'Medium', 'Small', 'Tiny'];

        foreach ($sizes as $size) {
            Size::firstOrCreate(['slug' => Str::slug($size)], ['name' => $size]);
        }

    }
}
