<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;

class PagesController extends Controller
{

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth', ['only' => 'dashboard']);
    }

    /**
     * Shows the pages.index view.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        return view('pages.index');
    }

    /**
     * Shows the pages.export view.
     *
     * @return \Illuminate\Http\Response
     */
    public function export(){
        return view('books.export');
    }

    /**
     * Finds a collection of all books, ordered by specific field, specified
     * by orderType parameter Then shows the pages.dashboard view.
     *
     * @param string $orderType
     * @return \Illuminate\Http\Response
     */
    public function dashboard($orderType)
    {
        if ($orderType == 'titles') {
            //Sort by titles
            $books = Book::where('user_id', auth()->user()->id)
                ->orderBy('title', 'asc')->paginate(20);
        } elseif ($orderType == 'authors') {
            //Sort by authors
            $books = Book::where('user_id', auth()->user()->id)
                ->orderBy('author', 'asc')->paginate(20);
        } else {
            //Sort by default -> titles
            $books = Book::where('user_id', auth()->user()->id)
                ->orderBy('title', 'asc')->paginate(20);
        }
        return view('pages.dashboard')->with('books', $books);
    }
}
