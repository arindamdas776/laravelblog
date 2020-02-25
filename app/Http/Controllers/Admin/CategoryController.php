<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('back-end.admin.category.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back-end.admin.category.create');
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
            'category_name' =>  'required',
            'select_image'  =>  'required|mimes:png,jpeg,jpg',
        ]);
        $image = $request->file('select_image');
        $slug = str_slug($request->category_name);

            if (isset($image)){
                $current_date = carbon::now()->toDateString();
                $image_name = $slug.'.'.$current_date.'.'.uniqid().'.'.$image->getClientOriginalExtension();
            }
                if (! Storage::disk('public')->exists('category')){
                    Storage::disk('public')->makeDirectory('category');
                }
                    $category_image = Image::make($image)->resize('1600','789')->stream();
                Storage::disk('public')->put('category/'.$image_name,$category_image);


                    if(!Storage::disk('public')->exists('category/slider')){
                        Storage::disk('public')->makeDirectory('category/slider');
                    }
                $slider_image = Image::make($image)->resize('500','320')->stream();
                    Storage::disk('public')->put('category/slider/'.$image_name,$slider_image);

                $category = new Category();
                $category->name = $request->category_name;
                $category->slug = $slug;
                $category->image = $image_name;

                $category->Save();

                Toastr::success('category has been Registered successfully');
                return redirect()->route('admincategories.index');
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
        $categories = Category::find($id);
        return view('back-end.admin.category.edit',compact('categories'));
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
            'category_name'     =>  'required',
        ]);
        $image_name = $request->hidden_image;
        $image = $request->file('select_image');
        $slug = str_slug($request->category_name);
        $category = Category::find($id);

        if (isset($image)){
            $current_date = carbon::now()->toDateString();
            $image_name = $slug.'.'.$current_date.'.'.uniqid().'.'.$image->getClientOriginalExtension();

            if (Storage::disk('public')->exists('category/'.$category->image)){
                Storage::disk('public')->delete('category/'.$category->image);
            }

                if (! Storage::disk('public')->exists('category')){
                    Storage::disk('public')->makeDirectory('category');
                }
                    $category_image = Image::make($image)->resize('1600','789')->stream();
                Storage::disk('public')->put('category/'.$image_name,$category_image);

            if (Storage::disk('public')->exists('category/slider/'.$category->image)){
                Storage::disk('public')->delete('category/slider/'.$category->image);
            }

                if (! Storage::disk('public')->exists('category/slider')){
                    Storage::disk('public')->makeDirectory('category/slider');
                }
                $slider_image = Image::make($image)->resize('500','320')->stream();
                Storage::disk('public')->put('category/slider/'.$image_name,$slider_image);

        }else{
            $category->image = $image_name;
        }

        $category->name = $request->category_name;
        $category->slug = $slug;
        $category->image = $image_name;

        $category->save();

        Toastr::success('category post has been updated successfully');
        return redirect()->route('admincategories.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

            if($category){
                $category->delete();
            }
            Toastr::success('Post category Deleted successfully');
            return redirect()->back();
    }
}
