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

    // public function latestBlog()
    // {
    //     // $allBlog = Blog::latest();
    //     $latestBlog = Blog::latest()->take(3)->get();

    //     return view('frontend.index', compact('latestBlog'));
    // }

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

    // Show Blog Details | Blog Details page for showing Blog Details via blog_slug Start
    public function blogDetails(string $blog_slug)
    {
        $blog = Blog::where('slug', $blog_slug)->first();

        if (!$blog) {
            // Blog not found, handle the situation (e.g., redirect or show error message)
            // For example:
            return redirect()->route('frontend.blog')->with('error', 'Blog not found.');
        }

        // Get related blogs from the same category
        $relatedBlogs = $blog->blogCategory->blogs()
            ->where('id', '!=', $blog->id)
            ->take(3)
            ->get();

        // If there are no related posts from the same category, get two posts from any other category
        if ($relatedBlogs->count() < 1) {
            $relatedBlogsFromOtherCategories = Blog::where('blog_category_id', '!=', $blog->blog_category_id)
                ->take(3 - $relatedBlogs->count())
                ->get();
            $relatedBlogs = $relatedBlogs->merge($relatedBlogsFromOtherCategories);
        }

        return view('frontend.blog.blog-details', compact('blog', 'relatedBlogs'));
    }


    // Blog Details page End

    // Show Posts under a single category
    public function blogsByCategory($category_slug) {
        $blogsByCategory = BlogCategory::where('slug', $category_slug)->first();

        $blogs = $blogsByCategory->blogs()->paginate(6); // Retrieve all blogs from $blogsByCategory

        return view('frontend.blog.blog-by-category', compact('blogsByCategory', 'blogs'));
    }

    // Show Posts under a single category
    public function blogsByTag($tag_slug) {
        $blogsByTag = Tag::where('slug', $tag_slug)->first();

        $blogs = $blogsByTag->blogs()->paginate(6); // Retrieve all blogs from $blogsByTag

        return view('frontend.blog.blog-by-tag', compact('blogsByTag', 'blogs'));
    }


}
