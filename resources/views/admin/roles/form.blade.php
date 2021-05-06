@extends('layouts.admin')

@section('title', 'Roles')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                @if(isset($role))
                    Edit exist role
                @else
                    Create new role
                @endif
            </h6>
        </div>
        <div class="card-body">
            @if(isset($role))
                {!! Form::model($role, ['url' => ['admin/roles', $role->id], 'method' => 'patch', 'class' => 'needs-validation']) !!}
            @else
                {!! Form::open(['url' => 'admin/roles', 'class' => 'needs-validation']) !!}
            @endif

            <div class="form-group col-sm-6">
                {!! Form::label('name', 'Name: ') !!}
                {!! Form::text('name', null, ['class' => 'form-control'.($errors->has('name') ? ' is-invalid' : ''), 'required' => 'required']) !!}
                {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-3">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
