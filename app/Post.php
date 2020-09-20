<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // if name table diferent not plural
    // protected $table='post';
    protected $fillable=['title','slug','body','category_id','thumbnail'];
    protected $with=['author','category','tags'];
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

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function author()
    {
        // Jika nama fungsi tidak sma dengan nama table, tambahi user_id sebagai fill identifier
        return $this->belongsTo(User::class,'user_id');
    }

    public function getTakeImageAttribute()
    {
        return "/storage/".$this->thumbnail;
    }

}
