<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     $categories = ProductCategory::all();

    //     return view('frontend.index', compact('categories'));
    // }

    /**
     * Show the featuredProduct based on Categories which has many featuredProducts.
    */
    // public function featuredProduct(){

    //     $categories = ProductCategory::all();

    //     // This categories which have featured products
    //     $categoriesHasFeaturedProducts = ProductCategory::whereHas('products', function ($query) {
    //         $query->where('is_featured', true);
    //     })->get();

    //     $featuredProducts = Product::where('is_featured', true)->get();

    //     return view('frontend.index', compact('categories','featuredProducts', 'categoriesHasFeaturedProducts'));
    // }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductCategory $productCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductCategory $productCategory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductCategory $productCategory)
    {
        //
    }
}
