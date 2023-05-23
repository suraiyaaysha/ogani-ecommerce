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
            // 'thumbnail' => 'frontend/assets/images/category-01.jpg',
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Vegetables',
            'slug' => 'vegetables',
            // 'thumbnail' => 'frontend/assets/images/category-02.jpg',
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Fruit & Nut Gifts',
            'slug' => 'Fruit-&-nut-gifts',
            // 'thumbnail' => 'frontend/assets/images/category-02.jpg',
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Fresh Berries',
            'slug' => 'fresh-berries',
            // 'thumbnail' => 'frontend/assets/images/category-02.jpg',
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Ocean Foods',
            'slug' => 'Ocean Foods',
            // 'thumbnail' => 'frontend/assets/images/category-02.jpg',
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Butter & Eggs',
            'slug' => 'Butter & Eggs',
            // 'thumbnail' => 'frontend/assets/images/category-02.jpg',
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Fastfood',
            'slug' => 'Fastfood',
            // 'thumbnail' => 'frontend/assets/images/category-02.jpg',
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Fresh Onion',
            'slug' => 'Fresh Onion',
            // 'thumbnail' => 'frontend/assets/images/category-02.jpg',
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Papayaya & Crisps',
            'slug' => 'Papayaya & Crisps',
            // 'thumbnail' => 'frontend/assets/images/category-02.jpg',
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Oatmeal',
            'slug' => 'Oatmeal',
            // 'thumbnail' => 'frontend/assets/images/category-02.jpg',
            // 'product_id' => '1',
        ]);

        ProductCategory::create([
            'name' => 'Fresh Bananas',
            'slug' => 'Fresh-Bananas',
            // 'thumbnail' => 'frontend/assets/images/category-02.jpg',
            // 'product_id' => '1',
        ]);

        // Create 5 Product
        ProductCategory::factory()->count(5)->create();
    }
}
