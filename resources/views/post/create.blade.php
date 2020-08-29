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
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror">
                            @error('title')
                                <div class="mt2 invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="title">Body</label>
                            <textarea name="body" id="body" class="form-control @error('title') is-invalid @enderror""></textarea>
                            @error('body')
                                <div class="mt2 invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@stop