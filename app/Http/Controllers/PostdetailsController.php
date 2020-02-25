<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostdetailsController extends Controller
{
    public function view($slug){
        $post = post::where('slug',$slug)->first();
        $random_post = Post::all()->random(3);
        $session_key = 'blog'.$post->id;

            if (!session::has($session_key)){
                $post->increment('view_count');
                session::put($session_key,1);
            }
        return view('front-end.post-details',compact('post','random_post'));
    }
}
