<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Wishlist;

class WishlistController extends Controller
{

    public function index()
    {
        $allWishlist = Wishlist::all();

        $products = Product::all();

        return view('frontend.shop.wishlist', compact('allWishlist', 'products'));
    }

    public function add(Product $product)
    {
        // Check if the product is already in the user's wishlist
        if (auth()->user()->wishlist->contains('product_id', $product->id)) {
            return redirect()->back()->with('error', 'Product already in wishlist.');
        }

        // Add the product to the user's wishlist
        Wishlist::create([
            'user_id' => auth()->id(),
            'product_id' => $product->id,
        ]);

        return redirect()->back()->with('success', 'Product added to wishlist.');
    }

    public function remove(Product $product)
    {
        // Find the wishlist entry for the given product and the authenticated user
        $wishlist = Wishlist::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        // Delete the wishlist entry if found
        if ($wishlist) {
            $wishlist->delete();
            return redirect()->back()->with('success', 'Product removed from wishlist.');
        }

        return redirect()->back()->with('error', 'Product not found in wishlist.');
    }
}
