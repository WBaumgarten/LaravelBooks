@extends('layouts.app')

@section('content')
<h1>Export Book Data</h1>
<hr>
<h3>CSV</h3>
<p>
    <table>
        <tr>
            <td>Titles And Authors:</td>
            <td class="blankCell"></td>
            <td><a href="/books/csv/titles&authors" type="button" class="btn btn-primary fa fa-download"></a></td>
        </tr>
        <tr class="blankRow">
            <td colspan="3"></td>
        </tr>
        <tr>
            <td>Titles Only:</td>
            <td class="blankCell"></td>
            <td><a href="/books/csv/titles" type="button" class="btn btn-primary fa fa-download"></a></td>
        </tr>
        <tr class="blankRow">
            <td colspan="3"></td>
        </tr>
        <tr>
            <td>Authors Only:</td>
            <td class="blankCell"></td>
            <td><a href="/books/csv/authors" type="button" class="btn btn-primary fa fa-download"></a></td>
        </tr>
    </table>
</p>
<hr>
<h3>XML</h3>
<p>
    <table>
        <tr>
            <td>Titles And Authors:</td>
            <td class="blankCell"></td>
            <td><a href="/books/xml/titles&authors" type="button" class="btn btn-primary fa fa-download"></a></td>
        </tr>
        <tr class="blankRow">
            <td colspan="3"></td>
        </tr>
        <tr>
            <td>Titles Only:</td>
            <td class="blankCell"></td>
            <td><a href="/books/xml/titles" type="button" class="btn btn-primary fa fa-download"></a></td>
        </tr>
        <tr class="blankRow">
            <td colspan="3"></td>
        </tr>
        <tr>
            <td>Authors Only:</td>
            <td class="blankCell"></td>
            <td><a href="/books/xml/authors" type="button" class="btn btn-primary fa fa-download"></a></td>
        </tr>
    </table>
</p>
@endsection
