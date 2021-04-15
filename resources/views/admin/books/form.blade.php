@extends('layouts.admin')

@section('title', 'Books')

@section('content')
    <div class="card">
        <div class="card-header">
            <h6 class="m-0 font-weight-bold text-primary">
                @if(isset($book))
                    Edit exist book
                @else
                    Create new book
                @endif
            </h6>
        </div>
        <div class="card-body">

            @if(isset($book))
                {!! Form::model($book, ['url' => ['admin/books', $book->id], 'method' => 'patch']) !!}
            @else
                {!! Form::open(['url' => 'admin/books']) !!}
            @endif

            <div class="form-group">
                {!! Form::label('title', 'Title: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('description', 'Description: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('isbn', 'ISBN: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('isbn', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('year', 'Year: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::select('year', $years, isset($book->year) ? $book->year : null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('pages', 'Pages: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('pages', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('quantity', 'Quantity: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::text('quantity', null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('publisher_id', 'Publisher: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::select('publisher_id', $publishers, null, ['class' => 'form-control', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('genre_id', 'Genre: ', ['class' => 'col-sm-3']) !!}
                <div class="col-sm-6">
                    {!! Form::select('genre_id', $genres, null, ['class' => 'form-control', 'required' => 'required']) !!}
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
