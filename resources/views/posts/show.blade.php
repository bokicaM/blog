@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-md-6 mx-auto">
            <div class="card mb-4 box-shadow">
                <img class="card-img-top"
                     src="{{asset('images/'.$post->thumbnail)}}"
                >
                <div class="card-body">
                    <h4>{{$post->title}}</h4>
                    <a href="/?category={{$post->category->slug}}"
                       class="p-2 my-2  text-decoration-none text-light text-wrap badge badge bg-primary"
                    >{{$post->category->name}}
                    </a>
                    <p class="card-text">{{$post->excerpt}}</p>
                    <hr>
                    <p class="card-text">{{$post->body}}</p>
                    <div class="d-flex justify-content-between mb-2">
                        <small class="text-muted">Views: {{$post->view_counter}}</small>
                        <small class="text-muted">{{$post->created_at->diffForHumans()}}</small>
                    </div>

                    <div class="d-flex justify-content-between align-items-center">

                        <div class="btn-group">
                            {{--                                    @auth--}}
                            @auth
                                <a href="{{route('posts.edit', $post)}}"
                                   class="btn btn-sm btn-outline-secondary">Edit</a>
                                <form method="POST" action="{{route('posts.destroy', $post)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="mx-2 btn btn-danger">Delete</button>
                                </form>
                            @endauth
                            {{--                                    @endauth--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
