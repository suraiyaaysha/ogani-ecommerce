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
use Illuminate\Database\Eloquent\Builder;
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

        $reviewedProducts = Product::whereHas('reviews', function (Builder $query) {
        $query->where('approved', true);
        })->get();

        return view('frontend.index',
            compact(
                'categories','featuredProducts', 'categoriesHasFeaturedProducts', 'latestProducts', 'reviewedProducts', 'discountedProducts',
                'latestAllBlog', 'colors', 'sizes', 'reviewedProducts'
            ));
    }

    public function getAllProducts(Request $request)
    {
        // Retrieve the selected colors and size from the request
        $selectedColors = $request->input('colors', []);
        $selectedSize = $request->input('size');

        // Retrieve the minimum and maximum prices from the request
        $minPrice = $request->input('min_price', 0);
        $maxPrice = $request->input('max_price', 1000); // Set a default maximum price

        // Retrieve all products
        $query = Product::query();

        // Apply color filter if any colors are selected
        if (!empty($selectedColors)) {
            $query->whereHas('colors', function ($query) use ($selectedColors) {
                $query->whereIn('color_id', $selectedColors);
            });
        }

        // Apply size filter if a size is selected
        if (!empty($selectedSize)) {
            $query->whereHas('sizes', function ($query) use ($selectedSize) {
                $query->where('size_id', $selectedSize);
            });
        }

        // Apply price filter
        $query->whereBetween('price', [$minPrice, $maxPrice]);

        // Apply sorting
        $sort = $request->input('sort');
        if ($sort === 'price_low_high') {
            $query->orderBy('price', 'asc');
        } elseif ($sort === 'price_high_low') {
            $query->orderBy('price', 'desc');
        } else {
            // Default sorting
            $query->orderBy('created_at', 'desc');
        }
        // Apply sorting

        // Retrieve the filtered products
        // $products = $query->latest()->paginate(9);

        // Retrieve the filtered products with pagination
        $products = $query->latest()->paginate(9)->appends($request->except('page'));

        // Retrieve the latest products
        $latestProducts = Product::latest()->take(9)->get();

        // Retrieve product categories
        $categories = ProductCategory::all();

        $colors = Color::all();
        $sizes = Size::all();

        // Share the selected sort value with the view
        $selectedSort = $sort;

        View::share('selectedColors', $selectedColors);
        View::share('selectedSize', $selectedSize);
        View::share('selectedSort', $selectedSort);

        return view('frontend.shop.index', compact('products', 'latestProducts', 'categories', 'colors', 'sizes', 'minPrice', 'maxPrice'));
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

        // Social Share start
        $buttons = \Share::page('https://www.vegeshop.ayshatech.com', 'Your share text enter here',)->facebook()->telegram()-> twitter()->linkedin()->whatsapp()->reddit();
         $products = Product::get();
        // Social Share end


        return view('frontend.shop.product-details', compact('product', 'relatedProducts', 'averageRating', 'reviewCount', 'buttons', 'products'));
    }

    public function productsByCategory($slug, Request $request)
    {
        $productsByCategory = ProductCategory::where('slug', $slug)->first();

        $products = $productsByCategory->products()->paginate(6); // Retrieve all products from $productsByCategory


        $selectedColors = $request->input('colors', []);
        $selectedSize = $request->input('size');


        return view('frontend.shop.products-by-category', compact('productsByCategory', 'products', 'selectedColors', 'selectedSize'));
    }

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

    /**
     * Search products based on category and keyword.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */
public function search(Request $request)
{
    $category = $request->input('category');
    $keyword = $request->input('search');

    // Perform the search query based on the category and keyword
    $query = Product::query();

    if (!empty($category)) {
        $query->where('product_category_id', $category);
    }

    if (!empty($keyword)) {
        $query->where('name', 'like', '%' . $keyword . '%');
    }

    // Apply sorting
    $sort = $request->input('sort');
    if ($sort === 'price_low_high') {
        $query->orderBy('price', 'asc');
    } elseif ($sort === 'price_high_low') {
        $query->orderBy('price', 'desc');
    } else {
        // Default sorting
        $query->orderBy('created_at', 'desc');
    }

    // Retrieve the minimum and maximum prices from the request
    $minPrice = $request->input('min_price', 0);
    $maxPrice = $request->input('max_price', 1000); // Set a default maximum price

    $products = $query->paginate();

    // Share the selected sort value with the view
    $selectedSort = $sort;

    $selectedColors = $request->input('colors', []);
    $selectedSize = $request->input('size');

    View::share('selectedSort', $selectedSort);

    return view('frontend.shop.search', compact('products', 'selectedColors', 'selectedSize', 'minPrice', 'maxPrice'));
}



}
