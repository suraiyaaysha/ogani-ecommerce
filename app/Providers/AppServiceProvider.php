<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


// For adding globally header category variable, So that I don't have to call the variable again & again.
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Support\Facades\View;

// Add pagination
use Illuminate\Pagination\Paginator;

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
            $view->with('categoriesHasFeaturedProducts',ProductCategory::whereHas('products', function ($query) {
            $query->where('is_featured', true);
        })->get());
        });
        // Share categoriesHasFeaturedProducts variable with index view
        View::composer('frontend.index', function ($view) {
            $view->with('featuredProducts', Product::where('is_featured', true)->get());
            $view->with('latestProducts', Product::get());
            $view->with('reviewedProducts', Product::has('reviews')->get());
        });


        // share allBlog variable with frontend.blog view
        View::composer('frontend.blog.index', function ($view) {
            // $view->with('allBlog', Blog::all());
            // $view->with('allBlog', Blog::all());
            $view->with('latestBlog', Blog::latest()->take(3)->get());
            $view->with('blogs', Blog::latest()
                    ->paginate(6));

            $view->with('blogCategories', BlogCategory::all());
        });


        // Add pagination
        // Paginator::defaultView('vendor.pagination.bootstrap-4');
        Paginator::useBootstrap();

    }
}
