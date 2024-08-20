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
            'thumbnail' => 'frontend/assets/img/categories/cat-1.jpg',
            'status' => 'active',
            'is_featured' => true,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Vegetables',
            'slug' => 'vegetables',
            'thumbnail' => 'frontend/assets/img/categories/cat-2.jpg',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Fruit & Nut Gifts',
            'slug' => 'fruit-nut-gifts',
            'thumbnail' => 'frontend/assets/img/categories/cat-3.jpg',
            'status' => 'active',
            'is_featured' => true,
        ]);

        ProductCategory::create([
            'name' => 'Fresh Berries',
            'slug' => 'fresh-berries',
            'thumbnail' => 'frontend/assets/img/categories/cat-4.jpg',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Ocean Foods',
            'slug' => 'ocean-foods',
            'thumbnail' => 'frontend/assets/img/categories/cat-5.jpg',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Butter & Eggs',
            'slug' => 'butter-eggs',
            'thumbnail' => 'frontend/assets/img/categories/cat-1.jpg',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Fastfood',
            'slug' => 'fastfood',
            'thumbnail' => 'frontend/assets/img/categories/cat-2.jpg',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Fresh Onion',
            'slug' => 'fresh-onion',
            'thumbnail' => 'frontend/assets/img/categories/cat-3.jpg',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Papayaya & Crisps',
            'slug' => 'papayaya-crisps',
            'thumbnail' => 'frontend/assets/img/categories/cat-4.jpg',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Oatmeal',
            'slug' => 'oatmeal',
            'thumbnail' => 'frontend/assets/img/categories/cat-5.jpg',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Fresh Bananas',
            'slug' => 'fresh-bananas',
            'thumbnail' => 'frontend/assets/img/categories/cat-1.jpg',
            'status' => 'active',
            'is_featured' => false,
            // 'product_id' => '1',
        ]);

        // Create 5 Product
        // ProductCategory::factory()->count(5)->create();
    }
}
