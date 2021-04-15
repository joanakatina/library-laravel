@extends('layouts.admin')

@section('title', 'Genres')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                @if(isset($genre))
                    Edit exist genre
                @else
                    Create new genre
                @endif
            </h6>
        </div>
        <div class="card-body">

            @if(isset($genre))
                {!! Form::model($genre, ['url' => ['admin/genres', $genre->id], 'method' => 'patch']) !!}
            @else
                {!! Form::open(['url' => 'admin/genres']) !!}
            @endif

            <div class="form-group">
                {!! Form::label('title', 'Title: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
