@extends('layouts.app')
@section('content')

    <div class="container">

        <div class="row">
            <div class="col-lg-12 margin-tb">
                <div class="pull-right">
                    <a class="btn btn-success" href="{{ route('categories.create') }}"> Dodaj novu kategoriju</a>
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
                <th>Id</th>
                <th>Naziv</th>
                <th>Broj pregleda</th>
                <th>Akcija</th>
            </tr>
            @foreach ($categories as $i => $category)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $category->name }}</td>
                    <td>{{ $category->posts->count() }}</td>
                    <td>
                        <form action="{{ route('categories.destroy',$category) }}" method="POST">
                            <a class="btn btn-primary" href="{{ route('categories.edit',$category) }}">Izmeni</a>
                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="btn {{auth()->user()->isAdmin() ? 'btn-danger' : 'btn-secondary'}}">Obriši
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        {!! $categories->links() !!}
    </div>
@endsection
