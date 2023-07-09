<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::all();
        $colors = Color::all();
        $sizes = Size::all();

        return view('admin.products.create', compact('categories', 'colors', 'sizes'));
    }

public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'information' => 'required',
        'price' => 'required',
        'discount' => 'nullable',
        'quantity' => 'required',
        'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'gallery_images' => 'nullable|array',
        'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'weight' => 'nullable',
        'shipping_duration' => 'nullable',
        'shipping_charge' => 'nullable',
        // 'is_featured' => 'required',
        'status' => 'required',
        'product_category_id' => 'required|exists:product_categories,id',
        'colors' => 'required|array',
        'colors.*' => 'exists:colors,id',
        'sizes' => 'required|array',
        'sizes.*' => 'exists:sizes,id',
    ]);

    // Retrieve the authenticated user
    $user = Auth::user();

    // Handle featured image
    $featuredImagePath = null;
    if ($request->hasFile('featured_image')) {
        $featuredImage = $request->file('featured_image');
        $featuredImageName = time() . '_' . $featuredImage->getClientOriginalName();
        $featuredImage->move(public_path('uploads/products'), $featuredImageName);
        $featuredImagePath = 'uploads/products/' . $featuredImageName;
    }

    // Handle gallery images
    $galleryImagePaths = [];
    if ($request->hasFile('gallery_images')) {
        foreach ($request->file('gallery_images') as $galleryImage) {
            $galleryImageName = time() . '_' . $galleryImage->getClientOriginalName();
            $galleryImage->move(public_path('uploads/products'), $galleryImageName);
            $galleryImagePaths[] = 'uploads/products/' . $galleryImageName;
        }
    }

    // Convert gallery images array to string
    $galleryImagesString = json_encode($galleryImagePaths);

    // Save the product
    $product = new Product;
    $product->name = $request->name;
    $product->slug = Str::slug($request->name);
    $product->description = $request->description;
    $product->information = $request->information;
    $product->price = $request->price;
    $product->discount = $request->discount;
    $product->quantity = $request->quantity;
    $product->featured_image = $featuredImagePath;
    $product->gallery_images = $galleryImagesString;
    $product->weight = $request->weight;
    $product->shipping_duration = $request->shipping_duration;
    $product->shipping_charge = $request->shipping_charge;
    $product->is_featured = $request->is_featured;
    $product->status = $request->status;
    $product->user_id = $user->id;
    $product->product_category_id = $request->product_category_id;
    $product->save();

    // Attach colors to the product
    $product->colors()->attach($request->colors);

    // Attach sizes to the product
    $product->sizes()->attach($request->sizes);

    return redirect()->route('products.index')->with('success', 'Product created successfully.');
}


    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = ProductCategory::all();
        $colors = Color::all();
        $sizes = Size::all();

        return view('admin.products.edit', compact('product', 'categories', 'colors', 'sizes'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'information' => 'required',
            'price' => 'required',
            'discount' => 'nullable',
            'quantity' => 'required',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images' => 'nullable|array',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'weight' => 'nullable',
            'shipping_duration' => 'nullable',
            'shipping_charge' => 'nullable',
            'is_featured' => 'required',
            'status' => 'required',
            'product_category_id' => 'required|exists:product_categories,id',
        ]);

        // Retrieve the authenticated user
        $user = Auth::user();

        // Update the product details
        $product->name = $request->name;
        $product->slug = Str::slug($request->name);
        $product->description = $request->description;
        $product->information = $request->information;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->quantity = $request->quantity;
        $product->weight = $request->weight;
        $product->shipping_duration = $request->shipping_duration;
        $product->shipping_charge = $request->shipping_charge;
        $product->is_featured = $request->is_featured;
        $product->status = $request->status;
        $product->user_id = $user->id;
        $product->product_category_id = $request->product_category_id;

        // Handle featured image update
        if ($request->hasFile('featured_image')) {
            // Delete the previous featured image
            if ($product->featured_image) {
                $this->deleteProductImage($product->featured_image);
            }

            // Upload and save the new featured image
            $featuredImage = $request->file('featured_image');
            $featuredImageName = time() . '_' . $featuredImage->getClientOriginalName();
            $featuredImage->move(public_path('uploads/products'), $featuredImageName);
            $product->featured_image = 'uploads/products/' . $featuredImageName;
        }

        // Handle gallery images update
        if ($request->hasFile('gallery_images')) {
            // Delete the previous gallery images
            if ($product->gallery_images) {
                foreach ($product->gallery_images as $galleryImage) {
                    $this->deleteProductImage($galleryImage);
                }
            }

            // Upload and save the new gallery images
            $galleryImagePaths = [];
            foreach ($request->file('gallery_images') as $galleryImage) {
                $galleryImageName = time() . '_' . $galleryImage->getClientOriginalName();
                $galleryImage->move(public_path('uploads/products'), $galleryImageName);
                $galleryImagePaths[] = 'uploads/products/' . $galleryImageName;
            }
            $product->gallery_images = $galleryImagePaths;
        }

        // Save the updated product
        $product->save();

        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        // Delete the associated reviews
        $product->reviews()->delete();

        // Delete the featured image file
        if ($product->featured_image) {
            $this->deleteProductImage($product->featured_image);
        }

        // Delete the gallery images files
        if ($product->gallery_images) {
            foreach ($product->gallery_images as $image) {
                $this->deleteProductImage($image);
            }
        }

        // Detach sizes and colors from the product
        $product->sizes()->detach();
        $product->colors()->detach();

        // Delete the product
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }

    protected function deleteProductImage($imageName)
    {
        $imagePath = public_path($imageName);

        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }
    }

}
