<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index(){
        return view('back-end.admin.setting');
    }
    public function update(Request $request,$id){
        $this->validate($request,[
            'select_image'  =>  'required|mimes:png,jpeg,jpg',
        ]);
        $image = $request->file('select_image');
        $slug = str_slug(Auth::user()->name);

            if(isset($image)){
                $current_date = carbon::now()->toDateString();
                $image_name = $slug.'.'.$current_date.'.'.$image->getClientOriginalExtension();
            }
                if (! Storage::disk('public')->exists('profile')){
                    Storage::disk('public')->makeDirectory('profile');
                }
             $profile_image = Image::make($image)->resize('500','300')->stream();
                Storage::disk('public')->put('profile/'.$image_name,$profile_image);

             $profile = User::find(Auth::id());

             $profile->image = $image_name;
             $profile->save();

             Toastr::success('Profile Updated successfully');
             return redirect()->back();
    }
    public function update_password(Request $request){
        $this->validate($request,[
            'old_password'  =>  'required',
        'new_password'  =>       'required',
        'confirm_password'      =>  'required',
        ]);
        $hash_password = Auth::user()->password;

            if (Hash::check($request->old_password,$hash_password)){
                if (! Hash::check($request->new_password,$hash_password)){
                    $user = User::findOrFail(Auth::id());
                    $user->password = Hash::make($request->new_password);
                    $user->save();

                    Auth::logout();
                }else{
                    Toastr::error('Password dont be same as the old password');
                }
            }else{
                Toastr::error('password Doesnot matched');
            }
            return redirect()->back();
    }
}
