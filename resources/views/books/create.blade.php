@extends('layouts.app')

@section('content')
<h1>Create A New Book Entry</h1>
<hr>
{!! Form::open(['action' => 'BooksController@store', 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('author', 'Author')}}
        {{Form::text('author', '', ['class' => 'form-control', 'placeholder' => 'Author'])}}
    </div>
{{Form::submit('Create', ['class' => 'btn btn-primary'])}}
{!! Form::close() !!}
@endsection
