<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Blog;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
// use App\Models\Purchase;
use App\Models\Order;
use App\Models\OrderItem;
// use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\View;

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


        // Share $selectedColors with the AppServiceProvider
        View::share('selectedColors', $selectedColors);

        // Share $selectedSize with the AppServiceProvider
        View::share('selectedSize', $selectedSize);


        return view('frontend.shop.index', compact('products', 'latestProducts', 'categories', 'colors', 'sizes'));
        // return view('frontend.shop.index', compact('products', 'latestProducts', 'categories', 'colors', 'sizes', 'selectedColors', 'selectedSize'));
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

        // To display the average rating and the number of reviews start

        // Calculate the average rating
        $averageRating = $product->reviews()->avg('star_rating');

        // Count the number of reviews
        $reviewCount = $product->reviews()->count();

        // To display the average rating and the number of reviews end

        return view('frontend.shop.product-details', compact('product', 'relatedProducts', 'averageRating', 'reviewCount'));
    }

    public function productsByCategory($slug, Request $request)
    {
        $productsByCategory = ProductCategory::where('slug', $slug)->first();

        $products = $productsByCategory->products()->paginate(6); // Retrieve all products from $productsByCategory


        $selectedColors = $request->input('colors', []);
        $selectedSize = $request->input('size');


        return view('frontend.shop.products-by-category', compact('productsByCategory', 'products', 'selectedColors', 'selectedSize'));
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


    public function submitReview(Request $request, $productId)
    {
        // Check if the user is logged in
        if (Auth::check()) {
            // Retrieve the logged-in user
            $user = Auth::user();

            // Find the product by ID
            $product = Product::findOrFail($productId);

            // $purchasedProduct = OrderItem::findOrFail($productId);

            // Check if the user has purchased the product
            $purchased = Order::where('user_id', $user->id)
                ->where('status', 'completed')
                ->exists();

            // Check if the Product Id present into the OrderITem
            $purchasedItem = OrderItem::where('product_id', $productId)
                ->exists();

            if ($purchased && $purchasedItem) {
                // Create a new review
                $review = new Review();
                $review->body = $request->input('review');
                $review->star_rating = $request->input('rating');
                $review->user_id = $user->id;

                // Associate the review with the product
                $product->reviews()->save($review);

                // Optionally, you can redirect the user to the product page
                // return redirect()->route('frontend.productDetails', $product->id)->with('success', 'Review submitted successfully.');

                return redirect()->back()->with('success', 'Review submitted successfully.');

                 // Set success flash message
                // $request->session()->flash('success', 'Review submitted successfully.');

            } else {
                // User has not purchased the product
                return redirect()->back()->with('error', 'You can only review products you have purchased.');

                 // Set error flash message
                // $request->session()->flash('error', 'You can only review products you have purchased.');
            }
        }

        // Redirect the user to the login page
        return redirect()->route('login')->with('error', 'Please log in to submit a review.');
    }

}
