<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class searchController extends Controller
{
    public function post()
    {
        $query=request('query');
        $posts=Post::where("title","like","%$query%")->latest()->paginate(6);
        return view('post.index',compact('posts'));
    }
}
