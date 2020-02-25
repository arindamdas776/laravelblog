<?php

namespace App\Http\Controllers\Admin;

use App\Notifications\AuthorNitification;
use App\Post;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;

class PendingpostController extends Controller
{
    public function index()
    {
        $pending_post = Post::where('is_approve',false)->get();
        return view('back-end.admin.pending-post',compact('pending_post'));

    }
    public function approve($id){
        $post = Post::findOrFail($id);

            if($post){
                $post->is_approve = true;
                $post->save();
            }

            $author = User::where('role_id','1')->get();

        Notification::send($author, new AuthorNitification($post));

            Toastr::success('post Approves successfully');
            return redirect()->back();
    }
}
