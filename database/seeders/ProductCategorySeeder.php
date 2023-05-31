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
            'slug' => 'Fruit-&-nut-gifts',
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
            'slug' => 'Ocean Foods',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/00dd66?text=excepturi',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Butter & Eggs',
            'slug' => 'Butter & Eggs',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/00dd66?text=excepturi',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Fastfood',
            'slug' => 'Fastfood',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/00dd66?text=excepturi',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Fresh Onion',
            'slug' => 'Fresh Onion',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/00dd66?text=excepturi',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Papayaya & Crisps',
            'slug' => 'Papayaya & Crisps',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/00dd66?text=excepturi',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Oatmeal',
            'slug' => 'Oatmeal',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/00dd66?text=excepturi',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Fresh Bananas',
            'slug' => 'Fresh-Bananas',
            'thumbnail' => 'https://via.placeholder.com/640x480.png/00dd66?text=excepturi',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        // Create 5 Product
        // ProductCategory::factory()->count(5)->create();
    }
}
