@extends('layout.app')

@section('title','Index')

@section('content')
    <div class="container">
        <h3>All Post</h3>
        <div class="row">
            <div class="col-md-6">
                @foreach($posts as $post)
                    <div class="card mb-3">
                        <div class="card-header">{{$post->title}}</div>
                        <div class="card-body">
                            {{Str::limit($post->body,100,'...')}}
                            <div>
                                <a href="post/{{$post->slug}}">Readmore</a>
                            </div>
                        </div>
                        <div class="card-footer">
                            Published on {{$post->created_at->format('d F Y')}}, ({{$post->created_at->diffForHumans()}})
                        </div>
                    </div>
                @endforeach
                {{$posts->links()}}
            </div>
        </div>
    </div>
@stop