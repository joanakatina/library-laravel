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

            <div class="form-group col-sm-6">
                {!! Form::label('title', 'Title: ') !!}
                {!! Form::text('title', null, ['class' => 'form-control'.($errors->has('title') ? ' is-invalid' : ''), 'required' => 'required']) !!}
                {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('website', 'Website: ') !!}
                {!! Form::text('website', null, ['class' => 'form-control'.($errors->has('website') ? ' is-invalid' : '')]) !!}
                {!! $errors->first('website', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('phone', 'Phone: ') !!}
                {!! Form::text('phone', null, ['class' => 'form-control'.($errors->has('phone') ? ' is-invalid' : '')]) !!}
                {!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-3">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
