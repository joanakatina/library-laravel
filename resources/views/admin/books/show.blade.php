@extends('layouts.admin')

@section('title', 'Books')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ url('/admin/books/'.$book->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit book</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>ID</td>
                        <td>{{ $book->id }}</td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td>{{ $book->title }}</td>
                    </tr>
                    <tr>
                        <td>Description</td>
                        <td>{{ $book->description }}</td>
                    </tr>
                    <tr>
                        <td>ISBN</td>
                        <td>{{ $book->isbn }}</td>
                    </tr>
                    <tr>
                        <td>Year</td>
                        <td>{{ $book->year }}</td>
                    </tr>
                    <tr>
                        <td>Pages</td>
                        <td>{{ $book->pages }}</td>
                    </tr>
                    <tr>
                        <td>Quantity</td>
                        <td>{{ $book->quantity }}</td>
                    </tr>
                    <tr>
                        <td>Publisher</td>
                        <td>{{ $book->publisher->title }}</td>
                    </tr>
                    <tr>
                        <td>Genre</td>
                        <td>{{ $book->genre->title }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
