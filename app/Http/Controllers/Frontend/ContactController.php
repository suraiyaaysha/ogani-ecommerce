<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cms;

class ContactController extends Controller
{
    public function contactCms()
    {
        $cms = Cms::first();
        return view('frontend.contact.index', compact('cms'));
    }
}
