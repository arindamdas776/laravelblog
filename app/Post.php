<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function category()
    {
        return $this->belongsToMany('App\Category')->withTimeStamps();
    }
    public function tag()
    {
        return $this->belongsToMany('App\Tag')->withTimeStamps();
    }
    public function user_to_favorite_post()
    {
        return $this->belongsToMany('App\User')->withTimestamps();
    }
    public function comment()
    {
        return $this->hasMany('App\comment');
    }
}
