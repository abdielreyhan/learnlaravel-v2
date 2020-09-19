@extends('layout.app')

@section('title','Index')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                @isset($category)
                    <h4>Category {{$category->name}}</h4>
                @endisset

                @isset($tag)
                    <h4>Tag {{$tag->name}}</h4>
                @endisset
                @if(!isset($tag) && !isset($category))
                    <h3>All Post</h3>
                @endif
                <hr>
            </div>
            <div>
                @if(Auth::check())
                    <a class="btn btn-primary" href="{{route('posts.create')}}">Create Post</a>
                @endif
            </div>
        </div>
        <div class="row">
            @forelse($posts as $post)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <div class="card-header">{{$post->title}}</div>
                        <div class="card-body">
                            {{Str::limit($post->body,100,'...')}}
                            <div>
                                <a href="/post/{{$post->slug}}">Readmore</a>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            Published on {{$post->created_at->format('d F Y')}}, ({{$post->created_at->diffForHumans()}})
                            @can('update',$post)
                                <a href="/post/{{$post->slug}}/edit" class="btn btn-sm btn-primary">Edit</a>
                            @endcan
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-info">Nothing to Show   </div>
            @endforelse
        
           
           
        </div>

        <div class="d-flex justify-content-center">
            <div>
                {{$posts->links()}}
            </div>
        </div>
    </div>
@stop