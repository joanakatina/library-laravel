@extends('layouts.admin')

@section('title', 'Publishers')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                @if(isset($publisher))
                    Edit exist publisher
                @else
                    Create new publisher
                @endif
            </h6>
        </div>
        <div class="card-body">

            @if(isset($publisher))
                {!! Form::model($publisher, ['url' => ['admin/publishers', $publisher->id], 'method' => 'patch']) !!}
            @else
                {!! Form::open(['url' => 'admin/publishers']) !!}
            @endif

            <div class="form-group">
                {!! Form::label('title', 'Title: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('website', 'Website: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('website', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('phone', 'Phone: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
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
