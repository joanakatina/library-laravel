@extends('layouts.admin')

@section('title', 'Publishers')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ url('/admin/publishers/'.$publisher->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit publisher</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>ID</td>
                        <td>{{ $publisher->id }}</td>
                    </tr>
                    <tr>
                        <td>Title</td>
                        <td>{{ $publisher->title }}</td>
                    </tr>
                    <tr>
                        <td>Website</td>
                        <td>{{ $publisher->website }}</td>
                    </tr>
                    <tr>
                        <td>Phone</td>
                        <td>{{ $publisher->phone }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
