<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
// use Illuminate\Http\Request;
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
        return view('post.create',['post'=>new Post]);

    }

    public function store(PostRequest $request)
    {
        $post=$request->all();
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
        
        session()->flash('success','The post was created');
        return redirect()->to('post');

        // if you want to back at this controller
        // return back();
    }

    public function edit(Post $post)
    {
        return view('post.edit',compact('post'));
    }

    public function update(PostRequest $request,Post $post)
    {  
        $change=$request->all();
        
        
        $post->update($change);

        session()->flash('success','The post was updated');
        return redirect()->to('post');
    }

}
