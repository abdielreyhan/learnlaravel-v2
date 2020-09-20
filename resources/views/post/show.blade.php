@extends('layout.app')

@section('title',$post->title)

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                @if($post->thumbnail)
                    <img style="height:450px; object-fit:cover; object-position:center;" class="rounded w-100" src="{{$post->takeImage}}" alt="">  
                @endif
                <h3><p>{{$post->title}}</p></h3>
                <div class="text-secondary">
                    <a href="/categories/{{$post->category->slug}}">{{$post->category->name}}</a> &middot; {{$post->created_at->format("d F, Y")}} &middot; 
                    @foreach($post->tags as $tag)
                        <a href="/tags/{{$tag->slug}}">{{$tag->name}}</a>
                    @endforeach
                    <div class="media">
                        <img width="60" class="rounded-circle mr-3" src="{{$post->author->gravatar()}}" alt="">
                        <div class="media-body">
                            <div>
                                {{$post->author->name}}
                            </div>
                            {{'@'.$post->author->username}}
                        </div>
                    </div>
                </div>
        
                <hr>
                
                <p>{{$post->body}}</p>
                <!-- Button trigger modal -->
                <!-- @auth -->
                <div class="flex">
                    @can('update',$post)
                        <a href="/post/{{$post->slug}}/edit" class="btn btn-sm btn-primary">Edit</a>
                    @endcan
                </div>
                @can('delete',$post)
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                    Delete Post
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Postingan akan dihapus</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    Apakah anda yakin?
                                    <form action="/post/{{$post->slug}}/delete" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <div class="d-flex">
                                            <button type="submit" class="btn btn-danger mr-2">Delete</a>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endcan
                <!-- @endauth -->
            </div>
            <div class="col-md-4">
                @foreach($posts as $post)
                    <div class="card mb-4">
                        @if($post->thumbnail)
                            <a href="{{route('posts.show',$post->slug)}}">
                                <img style="height:270px; object-fit:cover; object-position:center;" class="card-img-top" src="{{$post->takeImage}}" alt="">
                            </a>
                        @endif
                        <div class="card-body">
                            <div>
                                <a href="{{route('categories.show',$post->category->slug)}}" class="text-secondary"><small>{{$post->category->name}} - </small></a>
                                @foreach($post->tags as $tag)
                                    <a href="{{route('tags.show',$tag->slug)}}" class="text-secondary"><small>{{$tag->name}}</small></a>
                                @endforeach
                            </div>
                            <h5><a href="{{route('posts.show',$post->slug)}}" class="card-title text-dark">{{$post->title}}</a></h5>
                            <div class="text-secondary my-3">
                                {{Str::limit($post->body,100,'...')}}
                            </div>
                            <!-- <div>
                                <a href="/post/{{$post->slug}}">Readmore</a>
                            </div> -->
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            Published on {{$post->created_at->format('d F Y')}}, ({{$post->created_at->diffForHumans()}})
                            
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
       
    </div>
@endsection