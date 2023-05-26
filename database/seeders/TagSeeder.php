<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Tag;
use App\Models\Product;
use App\Models\Blog;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {;
        $tags = Tag::factory(10)->create();

        // Tag::factory(10)->create();


        foreach($tags as $tag) {
            $products = Product::inRandomOrder()->limit(5)->get();
            $tag->products()->attach($products);

            $blogs = Blog::inRandomOrder()->limit(5)->get();
            $tag->blogs()->attach($blogs);
        }
    }
}
