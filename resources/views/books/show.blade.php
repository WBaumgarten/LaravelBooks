@extends('layouts.app')

@section('content')
<h1>{{$book->title}}</h1>
<hr>
<p>
    <h3>Information:</h3>
    <table>
        <tr>
            <td><b>Author:</b></td>
            <td class="blankCell"></td>
            <td>{{$book->author}}</td>
        </tr>
        <tr>
            <td><b>Created By:</b></td>
            <td class="blankCell"></td>
            <td>{{$creator->name}}</td>
        </tr>
        <tr>
            <td><b>Created At:</b></td>
            <td class="blankCell"></td>
            <td>{{$book->created_at}}</td>
        </tr>
        <tr>
            <td><b>Last Updated By:</b></td>
            <td class="blankCell"></td>
            <td>{{$updater->name}}</td>
        </tr>
        <tr>
            <td><b>Updated At:</b></td>
            <td class="blankCell"></td>
            <td>{{$book->updated_at}}</td>
        </tr>
    </table>
</p>
@endsection
