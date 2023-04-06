@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-12 pt-2">
                <a href="{{route('categories.index')}}" class="btn btn-outline-dark ">Go back</a>
                <div class="border rounded mt-5 pl-4 pr-4 pt-4 pb-4">
                    <h1 class="display-6">Create a New Category</h1>
                    <hr>
                    <form action="" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mx-5">
                            <div class="control-group col-12 mt-2">
                                <label for="name">Category Name</label>
                                <input type="text" id="name" class="form-control" name="name"
                                       placeholder="Enter Category Name" required>
                            @if ($errors->any())
                                <div class="alert alert-danger p-0 my-2">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="control-group col-12 text-center">
                                <button id="btn-submit" class="btn btn-primary">
                                    Create Category
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

@endsection
