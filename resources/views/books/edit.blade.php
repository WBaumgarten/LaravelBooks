@extends('layouts.app')

@section('content')
<h1>Edit A Book Entry</h1>
<hr>
{!! Form::open(['action' => ['BooksController@update', $book->id], 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', $book->title, ['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('author', 'Author')}}
        {{Form::text('author', $book->author, ['class' => 'form-control', 'placeholder' => 'Author'])}}
    </div>
    {{Form::hidden('_method', 'PUT')}}
{{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
{!! Form::close() !!}
@endsection
