<?php

namespace App\Http\Controllers;

use App\Post;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add($id){
        $is_favorite_post = Auth::user()->favorite_post()->where('post_id',$id)->count();

            if ($is_favorite_post ==0){
                Auth::user()->favorite_post()->attach($id);
                Toastr::success('post Add to Favorite list');
                return redirect()->back();
            }else{
                Auth::user()->favorite_post()->detach($id);
                return redirect()->back();
            }
    }
}
