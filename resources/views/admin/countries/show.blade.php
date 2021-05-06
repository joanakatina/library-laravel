@extends('layouts.admin')

@section('title', 'Countries')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ url('/admin/countries/'.$country->id.'/edit') }}" class="btn btn-primary"><i class="fas fa-edit"></i> Edit country</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>ID</td>
                        <td>{{ $country->id }}</td>
                    </tr>
                    <tr>
                        <td>Code</td>
                        <td>{{ $country->country }}</td>
                    </tr>
                    <tr>
                        <td>Latitude</td>
                        <td>{{ $country->latitude }}</td>
                    </tr>
                    <tr>
                        <td>Longitude</td>
                        <td>{{ $country->longitude }}</td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>{{ $country->name }}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
