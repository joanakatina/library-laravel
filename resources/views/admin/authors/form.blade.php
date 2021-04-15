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

            <div class="form-group">
                {!! Form::label('first_name', 'First name: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('first_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('middle_name', 'Middle name: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('middle_name', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('last_name', 'Last name: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('last_name', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-6">
                    <div class="form-check form-check-inline">
                        {!! Form::radio('gender', '1', false, ['class' => 'form-check-input']) !!}
                        {!! Form::label('gender', 'Man', ['class' => 'form-check-label']) !!}
                    </div>
                    <div class="form-check form-check-inline">
                        {!! Form::radio('gender', '2', false, ['class' => 'form-check-input']) !!}
                        {!! Form::label('gender', 'Woman', ['class' => 'form-check-label']) !!}
                    </div>
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
