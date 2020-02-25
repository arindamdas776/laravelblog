<?php

namespace App\Http\Controllers;

use App\comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostcommentController extends Controller
{
    public function store(Request $request,$id){
        $this->validate($request,[
        'comment'   =>  'required',
        ]);
        $comment = new comment();

        $comment->user_id = Auth::id();
        $comment->post_id = $id;
        $comment->comment = $request->comment;
        $comment->save();
        return redirect()->back();
    }
}
