@extends('layouts.admin')

@section('title', 'Authors')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                @if(isset($author))
                    Edit exist author
                @else
                    Create new author
                @endif
            </h6>
        </div>
        <div class="card-body">
            {{-- Form::model ir Form::open metodai automatiškai prideda prie formos CSRF žetoną, todėl atskirai jo aprašyti nereikia --}}
            @if(isset($author))
                {{-- Eamo įrašo redagavimo forma --}}
                {!! Form::model($author, ['url' => ['admin/authors', $author->id], 'method' => 'patch']) !!}
            @else
                {{-- Naujo įrašo įvedimo forma; metodo nereikia nurodyti, nes pagal nutylėjimą jis yra 'post' --}}
                {!! Form::open(['url' => 'admin/authors']) !!}
            @endif

            <div class="form-group col-sm-6">
                {!! Form::label('first_name', 'First name: ') !!}
                {!! Form::text('first_name', null, ['class' => 'form-control'.($errors->has('first_name') ? ' is-invalid' : '')]) !!}
                {!! $errors->first('first_name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('middle_name', 'Middle name: ') !!}
                {!! Form::text('middle_name', null, ['class' => 'form-control'.($errors->has('middle_name') ? ' is-invalid' : '')]) !!}
                {!! $errors->first('middle_name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('last_name', 'Last name: ') !!}
                {!! Form::text('last_name', null, ['class' => 'form-control'.($errors->has('last_name') ? ' is-invalid' : '')]) !!}
                {!! $errors->first('last_name', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                <div class="form-check form-check-inline @error('gender') is-invalid @enderror">
                    {!! Form::radio('gender', '1', false, ['class' => 'form-check-input']) !!}
                    {!! Form::label('gender', 'Man', ['class' => 'form-check-label']) !!}
                </div>
                <div class="form-check form-check-inline @error('gender') is-invalid @enderror">
                    {!! Form::radio('gender', '2', false, ['class' => 'form-check-input']) !!}
                    {!! Form::label('gender', 'Woman', ['class' => 'form-check-label']) !!}
                </div>
                {!! $errors->first('gender', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-3">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
