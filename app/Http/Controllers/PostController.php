<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function Show($slug)
    {
        $post=\DB::table('posts')->where('slug',$slug)->first();
        // dd($post);
        return view('post.show',compact('post'));
    }
}
