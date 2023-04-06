@extends('layouts.app')
@section('content')

    <div class="container">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('categories.create') }}"> Create New Category</a>
                </div>
            </div>
        </div>

        @if ($message = Session::get('success'))
            <div class="my-2 alert alert-success">
                <p>{{ $message }}</p>
            </div>
        @endif
        @if ($message = Session::get('error'))
            <div class="my-2 alert alert-danger">
                <p>{{ $message }}</p>
            </div>
        @endif

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Name</th>
                <th>Post count</th>
                <th>Action</th>
            </tr>
            @foreach ($categories as $i => $category)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->posts->count() }}</td>
                    <td>
                        <form action="{{ route('categories.destroy',$category) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('categories.edit',$category) }}">Edit</a>
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn {{auth()->user()->isAdmin() ? 'btn-danger' : 'btn-secondary'}}">Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        {!! $categories->links() !!}
    </div>
@endsection
