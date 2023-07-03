<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class ProductCategoryController extends Controller
{
    public function index()
    {
        $productCategories = ProductCategory::all();

        return view('admin.product-categories.index', compact('productCategories'));
    }

    public function create()
    {
        return view('admin.product-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'required|boolean',
        ]);

        $file = $request->thumbnail;
        $url = $file->move('uploads/product-category' , $file->hashName());

        $productCategory = ProductCategory::create([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            'thumbnail' => $url,
            'status' => $request->input('status'),
            'is_featured' => $request->input('is_featured'),
        ]);

        return redirect()->route('product-categories.index')->with('success', 'Product category created successfully.');
    }

    public function show(ProductCategory $productCategory)
    {
        return view('admin.product-categories.show', compact('productCategory'));
    }

    public function edit(ProductCategory $productCategory)
    {
        return view('admin.product-categories.edit', compact('productCategory'));
    }

    public function update(Request $request, ProductCategory $productCategory)
    {
        $request->validate([
            'name' => 'required|string',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'required|boolean',
        ]);

        // $thumbnailPath = $productCategory->thumbnail;

        // if ($request->hasFile('thumbnail')) {
        //     $thumbnail = $request->file('thumbnail');
        //     $thumbnailPath = $thumbnail->store('product-categories', 'public');
        // }

        if ($request->hasFile('thumbnail')) {
            $file = $request->file('thumbnail');
            $filename = $file->hashName();
            $file->move('uploads/product-category', $filename);

            // Delete previous photo
            if ($productCategory->thumbnail) {
                $previousPhotoPath = public_path($productCategory->thumbnail);
                if (file_exists($previousPhotoPath)) {
                    File::delete($previousPhotoPath);
                }
            }

            $productCategory->thumbnail = 'uploads/product-category/' . $filename; // Set the new profile photo URL
        }

        $productCategory->update([
            'name' => $request->input('name'),
            'slug' => Str::slug($request->input('name')),
            // 'thumbnail' => $thumbnailPath,
            'status' => $request->input('status'),
            'is_featured' => $request->input('is_featured'),
        ]);

        return redirect()->route('product-categories.index')->with('success', 'Product category updated successfully.');
    }

    public function destroy(ProductCategory $productCategory)
    {
        $productCategory->delete();

        return redirect()->route('product-categories.index')->with('success', 'Product category deleted successfully.');
    }
}
