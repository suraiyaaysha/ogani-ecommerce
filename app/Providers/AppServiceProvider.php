<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;


// For adding globally header category variable, So that I don't have to call the variable again & again.
use App\Models\ProductCategory;
// use App\Models\Product;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;
use App\Models\Product;
use App\Models\Color;
use App\Models\Size;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;

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

        View::composer('frontend.partials.shop-aside', function ($view) {
            $view->with('categories', ProductCategory::all());
            $view->with('colors', Color::all());
            $view->with('sizes', Size::all());
            $view->with('latestProducts', Product::latest()->take(9)->get());
        });

        // Share colors variable with all views
        // View::composer('*', function ($view) {
        //     $view->with('selectedColors', $this->getSelectedColors());
        //     $view->with('selectedSize', $this->getSelectedSize());
        //     $view->with('selectedSort', $this->getSelectedSort());
        //     $view->with('minPrice', Request::input('minPrice'));
        //     $view->with('maxPrice', Request::input('maxPrice'));
        // });

        // Add pagination
        Paginator::useBootstrap();
    }

    // /**
    //  * Get the selected colors based on the current request.
    //  *
    //  * @return array
    //  */
    // private function getSelectedColors()
    // {
    //     // Retrieve the selected colors based on your logic
    //     // For example, you can fetch it from the current request or any other source
    //     $selectedColors = []; // Your logic to retrieve the selected colors

    //     return $selectedColors;
    // }

    // /**
    //  * Get the selected size based on the current request.
    //  *
    //  * @return mixed|null
    //  */
    // private function getSelectedSize()
    // {
    //     // Retrieve the selected size based on your logic
    //     // For example, you can fetch it from the current request or any other source
    //     $selectedSize = null; // Your logic to retrieve the selected size

    //     return $selectedSize;
    // }

    // /**
    //  * Get the selected sort option based on the current request.
    //  *
    //  * @return mixed|null
    //  */
    // private function getSelectedSort()
    // {
    //     // Retrieve the selected sort option based on your logic
    //     // For example, you can fetch it from the current request or any other source
    //     $selectedSort = null; // Your logic to retrieve the selected sort option

    //     return $selectedSort;
    // }

}
