@extends('layouts.app')

@section('title', 'Authors')

@section('content')
    @foreach($authors as $item)
        <p>{{ $item->first_name }} {{ $item->middle_name }} {{ $item->last_name }}</p>
    @endforeach
@endsection
