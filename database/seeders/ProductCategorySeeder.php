<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


use App\Models\ProductCategory;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ProductCategory::create([
            'name' => 'Fresh Meat',
            'slug' => 'fresh-meat',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/00dd00?text=doloribus',
            'status' => 'active',
            'is_featured' => true,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Vegetables',
            'slug' => 'vegetables',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/0066ee?text=magni',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Fruit & Nut Gifts',
            'slug' => 'fruit-nut-gifts',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/009955?text=aut',
            'status' => 'active',
            'is_featured' => true,
        ]);

        ProductCategory::create([
            'name' => 'Fresh Berries',
            'slug' => 'fresh-berries',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/00dd66?text=excepturi',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Ocean Foods',
            'slug' => 'ocean-foods',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/00dd66?text=excepturi',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Butter & Eggs',
            'slug' => 'butter-eggs',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/00dd66?text=excepturi',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Fastfood',
            'slug' => 'fastfood',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/00dd66?text=excepturi',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Fresh Onion',
            'slug' => 'fresh-onion',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/00dd66?text=excepturi',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Papayaya & Crisps',
            'slug' => 'papayaya-crisps',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/00dd66?text=excepturi',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Oatmeal',
            'slug' => 'oatmeal',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/00dd66?text=excepturi',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Fresh Bananas',
            'slug' => 'fresh-bananas',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/00dd66?text=excepturi',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        // Create 5 Product
        // ProductCategory::factory()->count(5)->create();
    }
}
