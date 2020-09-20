<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\{Post , Tag, Category};

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts=Post::with('author','tags','category')->latest()->limit(10)->get();
        return view('home',compact('posts'));
    }
}
