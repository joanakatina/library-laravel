@extends('layouts.admin')

@section('title', 'Authors')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ url('/admin/authors/'.$author->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit author</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>ID</td>
                        <td>{{ $author->id }}</td>
                    </tr>
                    <tr>
                        <td>First name</td>
                        <td>{{ $author->first_name }}</td>
                    </tr>
                    <tr>
                        <td>Middle name</td>
                        <td>{{ $author->middle_name }}</td>
                    </tr>
                    <tr>
                        <td>Last name</td>
                        <td>{{ $author->last_name }}</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>{{ $author->gender == 1 ? 'Man' : 'Woman' }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
