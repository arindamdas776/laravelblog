<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index')->name('home');

Auth::routes();

Route::group(['middleware' => ['auth']],function(){
    route::post('/favorite-post/{id}/add','FavoriteController@add')->name('post.add');
    Route::post('/post-commnet/{id}','PostcommentController@store')->name('comment.store');
});
Route::get('post-details/{slug}','PostDetailsController@view')->name('post.details');
Route::get('/all-post','AllpostController@view')->name('allpost.view');
Route::get('post-by-category/{slug}','PostByCategoryController@view')->name('post.category');


Route::group(['as' => 'admin','prefix' => 'admin','namespace' => 'Admin','middleware'=>['auth','admin']],function(){
    route::get('/dashboard','Dashboardcontroller@index')->name('dashboard');
    route::resource('/tag','Tagcontroller');
    route::resource('/categories','CategoryController');
    route::resource('/post','PostController');
    route::get('/pending-post','PendingpostController@index')->name('post.pending');
    route::put('post-approve/{id}','PendingpostController@approve')->name('post.approve');
    route::get('profile','ProfileController@index')->name('profile');
    route::put('profile-update/{id}','ProfileController@update')->name('profile.update');
    route::put('profile/update-password/{id}','ProfileController@update_password')->name('password.update');
});

Route::group(['as' => 'author','prefix' =>'author', 'namespace' =>'Author', 'middleware' => ['auth','author']],function(){
    route::get('/dashboard','Dashboardcontroller@index')->name('dashboard');
    route::resource('/post','Postcontroller');
    route::get('/profile','ProfileController@index')->name('profile');
    route::put('/profile-update/{id}','ProfileController@update')->name('profile.update');
    route::put('profile/update-password/{id}','ProfileController@update_password')->name('update.password');
});
