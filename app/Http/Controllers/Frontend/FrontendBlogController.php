<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;

class FrontendBlogController extends Controller
{

    public function getAllBlog()
    {
        $allBlog = Blog::all();

        return view('frontend.index', compact('allBlog'));
    }

}
