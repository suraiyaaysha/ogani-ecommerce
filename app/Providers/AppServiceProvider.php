<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


// For adding globally header category variable, So that I don't have to call the variable again & again.
use App\Models\ProductCategory;
// use App\Models\Product;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
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

        // });
        View::composer('frontend.partials.blog-aside', function ($view) {
            $view->with('blogCategories', BlogCategory::all());
            $view->with('latestAllBlog', Blog::latest()->take(3)->get());
            $view->with('tags', Tag::all());
        });

        // Add pagination
        Paginator::useBootstrap();

    }
}
