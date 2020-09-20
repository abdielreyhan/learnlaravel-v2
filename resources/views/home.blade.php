@extends('layout.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @forelse($posts as $post)
            <div class="col-md-8">
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
            </div>
        @empty
            <div class="alert alert-info">Nothing to Show   </div>
        @endforelse
    </div>
</div>
@endsection
