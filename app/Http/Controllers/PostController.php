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
        // with is like a join method. before protected with in model
        // $posts=Post::with('author','tags','category')->latest()->paginate(6);
        // after protected with in model
        $posts=Post::latest()->paginate(6);
        // return $posts;
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
        $posts=Post::latest()->limit(6)->get();
        // dd($posts);
        return view('post.show',compact('post','posts'));
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
        $request->validate([
            'thumbnail'=>'image|mimes:jpeg,png,ico,jpg|max:2048'
        ]);

        $attr=$request->all();
        $slug=\Str::slug(request('title'));
        $attr['slug']=$slug;
        if(request()->file('thumbnail')){
            // $thumbnailUrl=$thumbnail->storeAs("images/post","{$slug}.{$thumbnail->extension()}"); without encripted name
            $thumbnailUrl=request()->file('thumbnail')->store("images/post");
        }
        else{
            $thumbnailUrl=null;
        }
       
        // dd(request()->file('thumbnail'));
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
       
        $attr['category_id']=request('category'); //relation one to many put category_id in post
        $attr['thumbnail']=$thumbnailUrl; //for thumbnail
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

        $request->validate([
            'thumbnail'=>'image|mimes:jpeg,png,ico,jpg|max:2048'
        ]);

        if($request->file('thumbnail')){
            \Storage::delete($post->thumbnail);
            $thumbnailUrl=request()->file('thumbnail')->store("images/post");
        }
        else{
            $thumbnailUrl=$post->thumbnail;
        }
        $attr=$request->all();
        $attr['category_id']=request('category'); //relation one to many put category_id in post

        // $thumbnail;
        // $thumbnailUrl=$thumbnail->storeAs("images/post","{$slug}.{$thumbnail->extension()}");
       
        $attr['thumbnail']=$thumbnailUrl; //for thumbnial 
        
        $post->update($attr);
        $post->tags()->sync(request('tags')); //relation many to many

        session()->flash('success','The post was updated');
        return redirect()->to('post');
    }

    public function delete(Post $post)
    {
        $this->authorize('delete',$post);
        \Storage::delete($post->thumbnail);
        $post->tags()->detach();
        $post->delete();

        session()->flash('success','The post was Deleted');
        return redirect()->to('post');
        
        
    }
}
