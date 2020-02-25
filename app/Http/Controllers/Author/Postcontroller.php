<?php

namespace App\Http\Controllers\Author;

use App\Category;
use App\Notifications\AdminNotification;
use App\Post;
use App\Tag;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Postcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts =  Post::where('user_id','1')->get();
        return view('back-end.author.post.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::all();
        $tag = Tag::all();
        return view('back-end.author.post.create',compact('category','tag'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'post_title'    =>  'required',
            'select_image'  =>  'required',
            'body'          =>  'required',
        ]);
        $image = $request->file('select_image');
        $slug = str_slug($request->post_title);

        if (isset($image)){
            $current_date = carbon::now()->toDateString();
            $image_name = $slug.'.'.$current_date.'.'.uniqid().'.'.$image->getClientOriginalExtension();
        }
        if (! Storage::disk('public')->exists('post')){
            Storage::disk('public')->makeDirectory('post');
        }
        $post_image = Image::make($image)->resize('1600','789')->stream();
        Storage::disk('public')->put('post/'.$image_name,$post_image);

        $post = new Post();
        $post->title = $request->post_title;
        $post->user_id = Auth::id();
        $post->slug = $slug;
        $post->view_count = 1;
        $post->is_approve = false;

        if($request->status){
            $post->status = true;
        }else{
            $post->status = false;
        }
        $post->image = $image_name;
        $post->body = $request->body;
        $post->save();

        $post->category()->attach($request->category);
        $post->tag()->attach($request->tags);

        $admin = User::where('role_id','2')->get();
        Notification::send($admin, new AdminNotification($post));

        Toastr::success('post has been Registered successfully');
        return redirect()->route('authorpost.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $posts = Post::find($id);
        return view('back-end.author.Post.edit',compact('posts'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'post_title'    =>'required',
            'body'          => 'required',
        ]);
        $image_name = $request->hidden_image;
        $image = $request->file('select_image');
        $slug =  str_slug($request->post_title);
        $posts = Post::find($id);

        if(isset($image)){
            $current_date = carbon::now()->toDateString();
            $image_name = $slug.'.'.$current_date.'.'.uniqid().'.'.$image->getClientOriginalExtension();

            if(Storage::disk('public')->exists('post/'.$posts->image)){
                Storage::disk('public')->delete('post/'.$posts->image);
            }
            if(! Storage::disk('public')->exists('post')){
                Storage::disk('public')->makeDirectory('post');
            }
            $post_image = Image::make($image)->resize('1600','789')->stream();
            Storage::disk('public')->put('post/'.$image_name,$post_image);
        }else{
            $posts->image = $image_name;
        }
        $posts->title = $request->post_title;
        $posts->slug = $slug;
        $posts->image = $image_name;
        $posts->body = $request->body;
        $posts->save();

        $posts->category()->attach($request->category);
        $posts->tag()->attach($request->tags);



        Toastr::success('post has been updated successfully ');
        return redirect()->route('authorpost.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);

            if ($post){
                $post->delete();
            }
         Toastr::error('post Deleted successfully');
            return redirect()->route('authorpost.index');
    }
}
