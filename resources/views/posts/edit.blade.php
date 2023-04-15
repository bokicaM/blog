@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/" class="btn btn-outline-dark ">Nazad</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-6">Izmena posta</h1>
                    <hr>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row mx-5">
                            <div class="control-group col-12 mt-2">
                                <label for="title">Naslov</label>
                                <input type="text" id="title" class="form-control" name="title"
                                       value="{{ $post->title }}"
                                       placeholder="Enter Post Title" required>
                            </div>
                            <div class="control-group col-12 mt-2">
                                <label for="excerpt">Uvod</label>
                                <input type="text" id="excerpt" class="form-control" name="excerpt"
                                       value="{{ $post->excerpt }}"
                                       placeholder="Enter Post Excerpt" required>
                            </div>

                            <div class="control-group col-12 mt-2">
                                <label for="category">Kategorija</label>
                                <select class="form-select" name="category" aria-label="Default select example">
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}"
                                            {{$category->id == $post->category->id ? 'selected' : ''}}
                                        >{{$category->name}}</option>\
                                    @endforeach
                                </select>
                            </div>

                            <div class="control-group col-12 mt-2">
                                <label for="body">Tekst posta</label>
                                <textarea id="body" class="form-control" name="body" placeholder="Enter Post Body"
                                          rows="5" required>{{ $post->excerpt }}"</textarea>
                            </div>

                            <div class="image">
                                <label><h4>Dodaj sliku</h4></label>
                                <input type="file" class="form-control" name="thumbnail">
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button id="btn-submit" class="btn btn-primary">
                                    Izmeni post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
