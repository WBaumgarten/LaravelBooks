@extends('layouts.app')

@section('content')
@include('inc.showcase')
<h1>Home</h1>
<hr>
<p>
    LaravelBooks is a book database, created and edited by volunteers around the
    world. The goal of LaravelBooks is to enable the community to build their
    own database of books with their corresponding authors.
    The larger the database, the easier it will be to find some information on
    the book that you've been looking for, or finding more books from authors
    that you love.
</p>
<p>
    After you register an account, feel free to add new books to the database, or edit and
    remove incorrect entries.
    Since LaravelBook's data is managed by volunteers, it is the community's
    responsibility to make sure that correct information is entered.
</p>
    @endsection
