<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    //
    public function index (){
        
        $blogData = json_decode(Blog::OrderBy('id', 'desc')->get());
        return view('Frontend.blog', ['blogData' => $blogData]);
    }
    
}
