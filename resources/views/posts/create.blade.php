@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="/" class="btn btn-outline-dark ">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-6">Create a New Post</h1>
                    <hr>
                    @if ($errors->any())
                        <div class="alert alert-danger p-0 my-2 mx-5">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mx-5">
                            <div class="control-group col-12 mt-2">
                                <label for="title">Post Title</label>
                                <input type="text" id="title" class="form-control" name="title"
                                       placeholder="Enter Post Title">

                            </div>
                            <div class="control-group col-12 mt-2">
                                <label for="excerpt">Post Excerpt</label>
                                <input type="text" id="excerpt" class="form-control" name="excerpt"
                                       placeholder="Enter Post Excerpt">
                            </div>

                            <div class="control-group col-12 mt-2">
                                <label for="category">Post Category</label>

                                <select class="form-select" name="category" aria-label="Default select example" >
                                    <option selected>Pick a category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>\
                                    @endforeach
                                </select>
                            </div>

                            <div class="control-group col-12 mt-2">
                                <label for="body">Post Body</label>
                                <textarea id="body" class="form-control" name="body" placeholder="Enter Post Body"
                                          rows="5"></textarea>
                            </div>

                            <div class="image">
                                <label>Add image</label>
                                <input type="file" class="form-control" name="thumbnail">
                            </div>

                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button id="btn-submit" class="btn btn-primary">
                                    Create Post
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
