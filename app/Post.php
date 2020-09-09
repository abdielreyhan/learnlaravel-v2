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
    
    public function category()
    {
        return $this->belongsTo(Category::class);
        // if relation not category_id
        // return $this->belongsTo(Category::class,'subject');
    }

}
