@extends('layout.app')

@section('title','Index')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between">
            <div>
                <h3>All Post</h3>
                <hr>
            </div>
            <div>
                <a class="btn btn-primary" href="/post/create">Create Post</a>
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
                                <a href="post/{{$post->slug}}">Readmore</a>
                            </div>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            Published on {{$post->created_at->format('d F Y')}}, ({{$post->created_at->diffForHumans()}})
                            <a href="post/{{$post->slug}}/edit" class="btn btn-sm btn-primary">Edit</a>
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