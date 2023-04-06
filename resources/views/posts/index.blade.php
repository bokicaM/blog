@extends('layouts.app')
@section('content')

    <div class="container">

        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <strong>{{$message}}</strong>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="my-2 alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif


        <form method="GET" action="/" class="col-sm-4 my-2 mx-auto">

            <div class="d-flex align-items-center">
                @if (request('/category'))
                    <input type="hidden" name="category" value="{{ request('category') }}">
                @endif
                <input type="text" class="form-control border-secondary mx-2" name="search" placeholder="Search ..."
                       value="{{ request('search') }}">
                <a href="{{ route('posts.index') }}" class="btn btn-outline-dark btn-sm mx-2">Reset</a>
            </div>
        </form>
        <div class="my-3">
            <p class="p-0 m-0">Sort by</p>
            <a href="{{'?sortBy=oldest'}}" class="btn btn-outline-dark btn-sm mr-3">Asc</a>
            <a href="{{'?sortBy=newest'}}" class="btn btn-outline-dark btn-sm mr-3">Desc</a>
            <a href="{{'?sortBy=MostViews'}}" class="btn btn-outline-dark btn-sm mr-3">Most views</a>
        </div>
        <div class="row">
            @forelse($posts as $post)
                <div class="col-md-4">
                    <div class="card mb-4 box-shadow">
                        <img class="card-img-top"
                             src="{{asset('images/'.$post->thumbnail)}}"
                        >
                        <div class="card-body">
                            <h5>{{$post->title}}</h5>
                            <a href="/?category={{$post->category->slug}}"
                               class="p-2 my-2  text-decoration-none text-light text-wrap badge badge bg-primary"
                            >{{$post->category->name}}
                            </a>
                            <p class="card-text">{{$post->excerpt}}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <a href="{{route('posts.show', $post)}}" class="btn btn-sm btn-outline-secondary">View</a>
                                    @auth
                                        <a href="{{route('posts.edit', $post)}}"
                                           class="btn btn-sm btn-outline-secondary">Edit</a>
                                        <form method="POST" action="{{route('posts.destroy', $post)}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="mx-2 btn {{auth()->user()->isAdmin() ? 'btn-danger' : 'btn-secondary' }}">
                                                Delete
                                            </button>
                                        </form>
                                    @endauth
                                </div>
                                <small class="text-muted">{{$post->created_at->diffForHumans()}}</small>
                                <small class="text-muted">Views: {{$post->view_counter}}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <h1>No Posts</h1>
            @endforelse
            {{$posts->links() }}
        </div>
    </div>

@endsection
