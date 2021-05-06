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

            <div class="form-group col-sm-6">
                {!! Form::label('title', 'Title: ') !!}
                {!! Form::text('title', null, ['class' => 'form-control'.($errors->has('title') ? ' is-invalid' : ''), 'required' => 'required']) !!}
                {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-3">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
