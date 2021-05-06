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
                {!! Form::model($book, ['url' => ['admin/books', $book->id], 'method' => 'patch', 'enctype'=>'multipart/form-data']) !!}
            @else
                {!! Form::open(['url' => 'admin/books', 'enctype'=>'multipart/form-data']) !!}
            @endif

            <div class="form-group col-sm-6">
                {!! Form::label('title', 'Title: ') !!}
                {!! Form::text('title', null, ['class' => 'form-control'.($errors->has('title') ? ' is-invalid' : ''), 'required' => 'required']) !!}
                {!! $errors->first('title', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('description', 'Description: ') !!}
                {!! Form::textarea('description', null, ['class' => 'form-control'.($errors->has('description') ? ' is-invalid' : '')]) !!}
                {!! $errors->first('description', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('authors', 'Author: ') !!}
                {!! Form::text('authors', null, ['class' => 'ba-ex3 form-control']) !!}
                {!! $errors->first('authors', '<div class="invalid-feedback">:message</div>') !!}
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('.ba-ex3').boxautocomplete({
                            data: {!! json_encode($new_authors) !!},
                            search: true,
                            hideInput: true
                        });

                    });
                </script>
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('isbn', 'ISBN: ') !!}
                {!! Form::text('isbn', null, ['class' => 'form-control'.($errors->has('isbn') ? ' is-invalid' : ''), 'required' => 'required']) !!}
                {!! $errors->first('isbn', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('year', 'Year: ') !!}
                {!! Form::select('year', $years, isset($book->year) ? $book->year : null, ['class' => 'form-control'.($errors->has('year') ? ' is-invalid' : ''), 'required' => 'required']) !!}
                {!! $errors->first('year', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('pages', 'Pages: ') !!}
                {!! Form::text('pages', null, ['class' => 'form-control'.($errors->has('pages') ? ' is-invalid' : ''), 'required' => 'required']) !!}
                {!! $errors->first('pages', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('quantity', 'Quantity: ') !!}
                {!! Form::text('quantity', null, ['class' => 'form-control'.($errors->has('quantity') ? ' is-invalid' : ''), 'required' => 'required']) !!}
                {!! $errors->first('quantity', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('publisher_id', 'Publisher: ') !!}
                {!! Form::select('publisher_id', $publishers, null, ['class' => 'form-control'.($errors->has('publisher_id') ? ' is-invalid' : ''), 'required' => 'required']) !!}
                {!! $errors->first('publisher_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                {!! Form::label('genre_id', 'Genre: ') !!}
                {!! Form::select('genre_id', $genres, null, ['class' => 'form-control'.($errors->has('genre_id') ? ' is-invalid' : ''), 'required' => 'required']) !!}
                {!! $errors->first('genre_id', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-6">
                <div class="custom-file">
                    {!! Form::label('cover', 'Upload book cover image', ['class' => 'custom-file-label'.($errors->has('cover') ? ' is-invalid' : '')]) !!}
                    {!! Form::file('cover', ['class' => 'custom-file-input']) !!}
                    <script>
                        // Add the following code if you want the name of the file appear on select
                        $(".custom-file-input").on("change", function() {
                            var fileName = $(this).val().split("\\").pop();
                            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                        });
                    </script>
                </div>
                @if(isset($book->cover))
                    <img src="{{ url('uploads/covers', $book->cover) }}" height="100" class="mt-2">
                @endif
                {!! $errors->first('cover', '<div class="invalid-feedback">:message</div>') !!}
            </div>
            <div class="form-group col-sm-3">
                {!! Form::submit('Save', ['class' => 'btn btn-primary form-control']) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection
