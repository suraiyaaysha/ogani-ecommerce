<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\BlogCategory;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BlogCategory::create([
            'name' => 'Beauty',
            'slug' => 'beauty',
            // 'blog_id' => '1',
        ]);
        BlogCategory::create([
            'name' => 'Food',
            'slug' => 'food',
            // 'blog_id' => '1',
        ]);
        BlogCategory::create([
            'name' => 'Life Style',
            'slug' => 'life-style',
            // 'blog_id' => '1',
        ]);
        BlogCategory::create([
            'name' => 'Travel',
            'slug' => 'travel',
            // 'blog_id' => '1',
        ]);

        // Create 10 Blog Post
        BlogCategory::factory()->count(5)->create();
    }
}
