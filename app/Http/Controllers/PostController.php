<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts=Post::latest()->paginate(6);

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

    public function create()
    {
        return view('post.create');

    }

    public function store()
    {
        $post=request()->validate([
            'title'=>'required|min:3',
            'body'=>'required',
        ]);
        // ---------- Method 1
        // $post = new Post;

        // $post->title=$request->title;
        // $post->slug=\Str::slug($request->title);
        // $post->body=$request->body;

        // $post->save();

        // ------------ Method 2
        // Post::create([
        //     'title'=>$request->title,
        //     'slug'=>\Str::slug($request->title),
        //     'body'=>$request->body
        // ]);

        // ------------- Method 3
        // $post=$request->all();
        $post['slug']=\Str::slug(request('title'));
        Post::create($post);

        return redirect()->to('post');

        // if you want to back at this controller
        // return back();
    }
}
