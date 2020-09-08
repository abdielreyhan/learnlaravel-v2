@extends('layout.app')

@section('title',$post->title)

@section('content')
    <div class="container">
        <h3><p>{{$post->title}}</p></h3>
        <p>{{$post->body}}</p>

        <!-- Button trigger modal -->
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
    </div>
@endsection