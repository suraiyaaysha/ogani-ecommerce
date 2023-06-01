<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


// For adding globally header category variable, So that I don't have to call the variable again & again.
use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // For adding globally header category variable, So that I don't have to call the variable again & again.

        /*By using a view composer, you can share data across multiple views or layouts and avoid
        the need to pass the variable explicitly in each method.*/

        // Share categories variable with header view
        View::composer('frontend.layouts.header', function ($view) {
            $view->with('categories', ProductCategory::all());
        });

        // Share categories variable with index view
        View::composer('frontend.index', function ($view) {
            $view->with('categories', ProductCategory::all());
        });

        // Share categoriesHasFeaturedProducts variable with index view
        View::composer('frontend.index', function ($view) {
            $view->with('categoriesHasFeaturedProducts', ProductCategory::all());
        });
        // Share categoriesHasFeaturedProducts variable with index view
        View::composer('frontend.index', function ($view) {
            $view->with('featuredProducts', Product::all());
        });

    }
}
