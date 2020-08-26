<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // if name table diferent not plural
    // protected $table='post';
    public function scopeLatestFirst()
    {
        return $this->latest()->first();
    }
}
