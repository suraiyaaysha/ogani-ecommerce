<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{

    public function index()
    {
        $categories = ProductCategory::all();

        // This categories which have featured products
        $categoriesHasFeaturedProducts = ProductCategory::whereHas('products', function ($query) {
            $query->where('is_featured', true);
        })->get();

        $featuredProducts = Product::where('is_featured', true)->get();


        $latestProducts = Product::latest()->take(9)->get();

        $reviewedProducts = Product::has('reviews')->get();

        $discountedProducts = Product::where('discount', '>', 0)->get();
          // Calculate the discounted price for each discounted product
        foreach ($discountedProducts as $product) {
            $product->discounted_price = $product->price - (($product->price * $product->discount) / 100);
        }

        $latestAllBlog = Blog::latest()->take(3)->get();

        $colors = Color::all();
        $sizes = Size::all();


        return view('frontend.index',
            compact(
                'categories','featuredProducts', 'categoriesHasFeaturedProducts', 'latestProducts', 'reviewedProducts', 'discountedProducts',
                'latestAllBlog', 'colors', 'sizes'
            ));
    }


    public function getAllProducts()
    {
        // $products = Product::all();
        $products = Product::latest()->paginate(9);

        // get latest products
        $latestProducts = Product::latest()->take(9)->get();

        // get product categories
        $categories = ProductCategory::all();

        $colors = Color::all();
        $sizes = Size::all();

        return view('frontend.shop.index', compact('products', 'latestProducts', 'categories', 'colors', 'sizes'));
    }


    public function productDetails($slug)
    {
        $product = Product::where('slug', $slug)->first();


        if (!$product) {
            // product not found, handle the situation (e.g., redirect or show error message)
            // For example:
            return redirect()->route('frontend.blog')->with('error', 'Blog not found.');
        }

        // Get related blogs from the same category
        $relatedProducts = $product->productCategory->products()
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        // If there are no related products from the same category, get three products from any other category
        if ($relatedProducts->count() < 1) {
            $relatedProductsFromOtherCategories = Product::where('product_category_id', '!=', $product->product_category_id)
                ->take(4 - $relatedProducts->count())
                ->get();
            $relatedProducts = $relatedProducts->merge($relatedProductsFromOtherCategories);
        }


        return view('frontend.shop.product-details', compact('product', 'relatedProducts'));
    }


}
