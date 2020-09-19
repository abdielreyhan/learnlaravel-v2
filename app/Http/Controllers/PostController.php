<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
// use Illuminate\Http\Request;
use App\{Post , Tag, Category};
// use App\Tag;
// use App\Category;

class PostController extends Controller
{

    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index','show']);
    // }

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

        return view('post.create',[
            'post'=>new Post,
            'categories'=>Category::get(),
            'tags'=>Tag::get()
            ]);

    }

    public function store(PostRequest $request)
    {
        $attr=$request->all();
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
        $attr['slug']=\Str::slug(request('title'));
        $attr['category_id']=request('category'); //relation one to many put category_id in post
        // $attr['user_id']=auth()->id();

        // $post=Post::create($attr);
        $post=auth()->user()->posts()->create($attr);
        $post->tags()->attach(request('tags')); //relation many to many
        
        session()->flash('success','The post was created');
        return redirect()->to('post');

        // if you want to back at this controller
        // return back();
    }

    public function edit(Post $post)
    {
        return view('post.edit',[
            'post'=>$post,
            'categories'=>Category::get(),
            'tags'=>Tag::get()
        ]);
    }

    public function update(PostRequest $request,Post $post)
    {  
        $this->authorize('update',$post);
        $attr=$request->all();
        $attr['category_id']=request('category'); //relation one to many put category_id in post
       
        
        $post->update($attr);
        $post->tags()->sync(request('tags')); //relation many to many

        session()->flash('success','The post was updated');
        return redirect()->to('post');
    }

    public function delete(Post $post)
    {
        $this->authorize('delete',$post);
        $post->tags()->detach();
        $post->delete();

        session()->flash('success','The post was Deleted');
        return redirect()->to('post');
        
        
    }
}
