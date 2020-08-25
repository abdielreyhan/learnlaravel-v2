@extends('layout.app')

@section('title',$post->title)

@section('content')
    <div class="container">
        <h3><p>{{$post->title}}</p></h3>
        <p>{{$post->body}}</p>
    </div>
@endsection