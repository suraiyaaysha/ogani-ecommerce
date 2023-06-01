<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Tag;

class FrontendBlogController extends Controller
{

    public function index()
    {
        // $allBlog = Blog::all();
        // $blogs = Blog::paginate(6); // Change 10 to the number of blogs you want to display per page
        // $blogs = Blog::query()
        //             ->paginate(6);
        $blogs = Blog::latest()
                    ->paginate(6);

        // Call the latestBlog method to retrieve the latest 3 blog posts in other method, without declare method again and again
        $latestBlog = $this->latestBlog();

        return view('frontend.blog.index', compact('blogs', 'latestBlog'));
    }

    public function latestBlog()
    {
        // $allBlog = Blog::latest();
        $latestBlog = Blog::latest()->take(3)->get();

        return view('frontend.index', compact('latestBlog'));
    }

    public function getBlogCategories()
    {
        $blogCategories = BlogCategory::all();

        return view('frontend.blog.index', compact('blogCategories'));
    }

    public function getTags()
    {
        // Get all tags
        $tags = Tag::all();

        return view('frontend.blog.index', compact('tags'));
    }

}
