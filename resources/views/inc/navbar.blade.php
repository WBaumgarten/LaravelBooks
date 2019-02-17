<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                <li class="nav-item {{Request::is('/') ? 'active' : ''}}">
                    <a class="nav-link" href="/">Home</a>
                </li>
                @auth
                    <li class="nav-item {{Request::is('pages/dashboard/titles') ? 'active' : (Request::is('pages/dashboard/authors') ? 'active' : '')}}">
                        <a class="nav-link" href="/pages/dashboard/titles">Dashboard</a>
                    </li>
                @endauth
                <li class="nav-item {{Request::is('books/list/titles') ? 'active' : (Request::is('books/list/authors') ? 'active' : '')}}">
                    <a class="nav-link" href="/books/list/titles">List</a>
                </li>
                @auth
                    <li class="nav-item {{Request::is('books/create') ? 'active' : ''}}">
                        <a class="nav-link" href="/books/create">New</a>
                    </li>
                @endauth
                <li class="nav-item {{Request::is('books/export') ? 'active' : ''}}">
                    <a class="nav-link" href="/books/export">Export</a>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
                {!! Form::open(['action' => 'BooksController@search', 'method' => 'POST', 'class' => 'form-inline searchForm']) !!}
                {{Form::text('search', '', ['class' => 'form-control searchText', 'placeholder' => 'Search for Title or Author'])}}
                {{Form::submit('Search', ['class' => 'btn btn-primary form-control searchButton'])}}
                {!! Form::close() !!}
            </ul>
        </div>
    </div>
</nav>
<br>
