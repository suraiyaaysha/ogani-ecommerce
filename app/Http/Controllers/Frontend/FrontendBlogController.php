<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;

class FrontendBlogController extends Controller
{

    public function index()
    {
        // $allBlog = Blog::all();
        // $blogs = Blog::paginate(6); // Change 10 to the number of blogs you want to display per page
        $blogs = Blog::query()
                    ->paginate(5);




        return view('frontend.blog.index', compact('blogs'));
    }

    public function getAllBlog()
    {
        $allBlog = Blog::all();

        return view('frontend.index', compact('allBlog'));
    }

}
