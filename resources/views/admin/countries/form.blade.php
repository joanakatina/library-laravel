@extends('layouts.admin')

@section('title', 'Countries')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                @if(isset($country))
                    Edit exist country
                @else
                    Create new country
                @endif
            </h6>
        </div>
        <div class="card-body">
            @if(isset($country))
                {!! Form::model($country, ['url' => ['admin/countries', $country->id], 'method' => 'patch']) !!}
            @else
                {!! Form::open(['url' => 'admin/countries']) !!}
            @endif

            <div class="form-group col-sm-6">
                {!! Form::label('country', 'Code: ') !!}
                {!! Form::text('country', null, ['class' => 'form-control'.($errors->has('country') ? ' is-invalid' : '')]) !!}
                {!! $errors->first('country', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('latitude', 'Latitude: ') !!}
                {!! Form::text('latitude', null, ['class' => 'form-control'.($errors->has('latitude') ? ' is-invalid' : '')]) !!}
                {!! $errors->first('latitude', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('longitude', 'Longitude: ') !!}
                {!! Form::text('longitude', null, ['class' => 'form-control'.($errors->has('longitude') ? ' is-invalid' : '')]) !!}
                {!! $errors->first('longitude', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('name', 'Country: ') !!}
                {!! Form::text('name', null, ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : '')]) !!}
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-3">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
