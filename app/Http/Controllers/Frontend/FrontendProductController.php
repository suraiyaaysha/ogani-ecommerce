<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    public function getProductCategories()
    {
        $categories = ProductCategory::all();

        return view('frontend.index', compact('categories'));
    }

    /**
     * Show the featuredProduct based on Categories which has many featuredProducts.
    */
    public function featuredProduct(){

        $categories = ProductCategory::all();

        // This categories which have featured products
        $categoriesHasFeaturedProducts = ProductCategory::whereHas('products', function ($query) {
            $query->where('is_featured', true);
        })->get();

        $featuredProducts = Product::where('is_featured', true)->get();

        return view('frontend.index', compact('categories','featuredProducts', 'categoriesHasFeaturedProducts'));
    }

    public function latestProducts()
    {

        $latestProducts = Product::get();

        $reviewedProducts = Product::has('reviews')->get();

        return view('frontend.index', compact('latestProducts', 'reviewedProducts'));
    }

    /**
     * Get products with reviews.
    */
    public function productsWithReviews()
    {
        $latestProducts = Product::get();

        $reviewedProducts = Product::has('reviews')->get();

        return view('frontend.index', compact('reviewedProducts', 'latestProducts'));
    }

    // /**
    //  * Show the form for creating a new resource.
    //  */
    // public function create()
    // {
    //     //
    // }

    // /**
    //  * Store a newly created resource in storage.
    //  */
    // public function store(Request $request)
    // {
    //     //
    // }

    // /**
    //  * Display the specified resource.
    //  */
    // public function show(Product $product)
    // {
    //     //
    // }

    // /**
    //  * Show the form for editing the specified resource.
    //  */
    // public function edit(Product $product)
    // {
    //     //
    // }

    // /**
    //  * Update the specified resource in storage.
    //  */
    // public function update(Request $request, Product $product)
    // {
    //     //
    // }

    // /**
    //  * Remove the specified resource from storage.
    //  */
    // public function destroy(Product $product)
    // {
    //     //
    // }
}
