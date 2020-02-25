<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class AllpostController extends Controller
{
    public function  view(){
        $post = post::all();
        return view('front-end.all-post',compact('post'));
    }
}
