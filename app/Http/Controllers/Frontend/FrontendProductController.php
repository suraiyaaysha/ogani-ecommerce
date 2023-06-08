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

    // public function getAllProducts()
    public function getAllProducts(Request $request)
    {
        // $products = Product::all();
        $products = Product::latest()->paginate(9);

        // get latest products
        $latestProducts = Product::latest()->take(9)->get();

        // get product categories
        $categories = ProductCategory::all();

        $colors = Color::all();
        $sizes = Size::all();


        // Filter By Color Start
        $selectedColors = $request->input('colors', []);
        if (!empty($selectedColors)) {
            // Retrieve the products that have at least one selected color
            $products = Product::whereHas('colors', function ($query) use ($selectedColors) {
                $query->whereIn('color_id', $selectedColors);
            })->latest()->paginate(9);
        }
        // Filter By Color End

        // Filter By Size Start
        $selectedSize = $request->input('size');

        if (!empty($selectedSize)) {
            // Retrieve the products with the selected size
            $products = Product::whereHas('sizes', function ($query) use ($selectedSize) {
                $query->where('size_id', $selectedSize);
            })->latest()->paginate(9);
        }
        // Filter By Size End


        return view('frontend.shop.index', compact('products', 'latestProducts', 'categories', 'colors', 'sizes', 'selectedColors', 'selectedSize'));
        // return view('frontend.shop.index', compact('products'));
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

    public function productsByCategory($slug)
    {
        $productsByCategory = ProductCategory::where('slug', $slug)->first();

        $products = $productsByCategory->products()->paginate(6); // Retrieve all products from $productsByCategory

        return view('frontend.shop.products-by-category', compact('productsByCategory', 'products'));
    }


    // public function filterByColor(Request $request)
    // {
    //     $selectedColors = $request->input('colors');

    //     // Retrieve the products that have at least one selected color
    //     $products = Product::whereHas('colors', function ($query) use ($selectedColors) {
    //         $query->whereIn('color_id', $selectedColors);
    //     })->get();

    //     // Pass the filtered products to the view
    //     return view('frontend.shop.index', ['products' => $products]);
    // }



}
