@if (Request::is('pages/dashboard/*'))
    <a href="/pages/dashboard/titles" class="btn btn-primary">Order by Titles&nbsp;<span class="fa fa-sort"></span></a>
    &nbsp;&nbsp;
    <a href="/pages/dashboard/authors" class="btn btn-primary">Order by Authors&nbsp;<span class="fa fa-sort"></span></a>
    </br></br>
@elseif (Request::is('books/list/*'))
    <a href="/books/list/titles" class="btn btn-primary">Order by Titles&nbsp;<span class="fa fa-sort"></span></a>
    &nbsp;&nbsp;
    <a href="/books/list/authors" class="btn btn-primary">Order by Authors&nbsp;<span class="fa fa-sort"></span></a>
    </br></br>
@endif
    <ul class="list-group">
        <li class="list-group-item">
            <div class="row">
                <div class="col-xs-6 col-sm-5 col-md-6 col-lg-7">
                    <h4>Title</h4>
                </div>
                <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
                    <h4>Author</h4>
                </div>
                <div class="col-xs-12 col-sm-3 col-md-2 col-lg-2">
                </div>
            </div>
        </li>
    </ul>
@if (count($books) > 0)
    @foreach ($books as $book)
        <ul class="list-group">
            <li class="list-group-item">
                <div class="row">
                    <div class="col-xs-6 col-sm-5 col-md-6 col-lg-7">
                        <a href="/books/{{$book->id}}">
                            {{$book->title}}
                        </a>
                    </div>
                    <div class="col-xs-6 col-sm-4 col-md-4 col-lg-3">
                        {{$book->author}}
                    </div>
                    <div class="col-xs-6 col-sm-1 col-md-1 col-lg-1">
                        <a href="/books/{{$book->id}}/edit" type="button" class="btn btn-primary fa fa-edit"></a>
                    </div>
                    <div class="col-xs-6 col-sm-2 col-md-1 col-lg-1">
                        {!! Form::open(['action' => ['BooksController@destroy', $book->id], 'method' => 'POST']) !!}
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::button('', ['type' => 'submit', 'class' => 'btn btn-primary fa fa-trash'])}}
                        {!! Form::close() !!}
                    </div>
                </div>
            </li>
        </ul>
    @endforeach
    @if (Request::is('pages/dashboard/*') || Request::is('books/list/*'))
        {{$books->links()}}
    @endif
    <br><br>
@else
    <br>
    <p>No book entries found</p>
@endif
