@extends('layout.app',['title'=>'create new post'])


@section('content')
<div class="container">
  
    <div class="row">
    
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">New Post</div>
                <div class="card-body">
                    <form action="/post/store" method="POST">
                        @csrf
                        @include('post.partials.form-controls',['submit'=>'Submit'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop