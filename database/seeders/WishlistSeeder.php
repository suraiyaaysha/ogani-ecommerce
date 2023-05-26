<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Wishlist;
use App\Models\Product;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //  Wishlist::factory()
        //     ->count(10) // Adjust the number of wishlists to create as needed
        //     ->create();

        Wishlist::factory()
            ->count(10)
            ->create()
            ->each(function (Wishlist $wishlist) {
                $products = Product::inRandomOrder()->limit(5)->get();
                $wishlist->products()->attach($products);
            });
    }
}
