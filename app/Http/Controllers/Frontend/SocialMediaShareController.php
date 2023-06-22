<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Blog;

class SocialMediaShareController extends Controller
{
    public function index()
    {
        $buttons = \Share::page('https://www.vegeshop.ayshatech.com', 'Your share text enter here',)->facebook()->telegram()-> twitter()->linkedin()->whatsapp()->reddit()->instagram()->pinterest();
        $blogs = Blog::get();

        return view('frontend.blog.index', compact('buttons', 'blogs'));
    }
}
