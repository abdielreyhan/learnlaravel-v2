<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['name','slug'];
    public function posts()
    {
        return $this->hasMany(Post::class);
        // if fill in another table different not category_id
        // return $this->hasMany(Post::class,'subject');
    }
}
