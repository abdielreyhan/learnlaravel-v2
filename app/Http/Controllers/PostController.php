<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts=Post::latest()->paginate(3);

        return view('post.index',compact('posts'));
    }
    
    public function Show(Post $post)
    {
        // $post=Post::where('slug',$slug)->firstOrFail();
        // dd($post); 
        // vardump

        // for abort
        // if(!$post){
        //     abort(404);
        // }

        
        return view('post.show',compact('post'));
    }
}
