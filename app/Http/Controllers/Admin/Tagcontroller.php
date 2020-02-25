<?php

namespace App\Http\Controllers\Admin;

use App\Tag;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class Tagcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        return view('back-end.admin.Tag.index',compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.admin.Tag.create');
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
            'tag_name'  =>  'required',
        ]);
        $slug = str_slug($request->tag_name);
        $tag = new Tag();
        $tag->name = $request->tag_name;
        $tag->slug = $slug;
        $tag->save();

        Toastr::success('Post tag name has been Registered successfully');
        return redirect()->route('admintag.index');
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
        $tags = Tag::find($id);
        return view('back-end.admin.Tag.edit',compact('tags'));
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
            'tag_name'  =>  'required',
        ]);
        $slug = str_slug($request->tag_name);

        $tags = Tag::find($id);
        $tags->name = $request->tag_name;
        $tags->slug = $slug;
        $tags->Save();
       Toastr::success('Post Tag hasbeen Updated successfully');
       return redirect()->route('admintag.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tags = Tag::findOrFail($id);
            if ($tags){
                $tags->delete();
            }
            Toastr::success('Post tag Deleted successfully');
            return redirect()->back();
    }
}
