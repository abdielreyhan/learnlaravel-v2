<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // if name table diferent not plural
    // protected $table='post';
    protected $fillable=['title','slug','body'];
    // protected $guarded=[];
    // public function scopeLatestFirst()
    // {
    //     return $this->latest()->first();
    // }


}
