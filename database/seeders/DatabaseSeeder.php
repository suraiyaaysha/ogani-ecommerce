<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call([
            UserSeeder::class,
            UserDetailsSeeder::class,
            ProductCategorySeeder::class,
            ProductSeeder::class,
            BlogCategorySeeder::class,
            BlogSeeder::class,
            SubscriberSeeder::class,
            CouponSeeder::class,
            CompareSeeder::class,
            OrderSeeder::class,
            ReviewSeeder::class,
            CommentSeeder::class,
            TagSeeder::class,
            ContactSeeder::class,
            WishlistSeeder::class,
            BillingDetailsSeeder::class,
            ShippingDetailsSeeder::class,
        ]);

    }
}
