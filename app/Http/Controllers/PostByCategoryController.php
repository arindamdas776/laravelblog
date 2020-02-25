<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

class PostByCategoryController extends Controller
{
    public function view($slug){
        $category = Category::where('slug',$slug)->first();
        return view('front-end.post-by-category',compact('category'));
    }
}
