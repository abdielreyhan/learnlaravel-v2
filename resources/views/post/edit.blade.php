@extends('layout.app',['title'=>'Edit post'])


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Update Post {{$post->title}}</div>
                <div class="card-body">
                    <form action="/post/{{$post->slug}}/edit" method="POST">
                        @method('patch')
                        @csrf
                        @include('post.partials.form-controls')
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop