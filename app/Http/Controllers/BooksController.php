<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\User;

class BooksController extends Controller
{

    /**
    * Create a new controller instance.
    *
    * @return void
    */
    public function __construct()
    {
        $this->middleware('auth', ['only' => ['create', 'edit', 'destroy']]);
    }

    /**
    * Display a listing of the resource, ordered by title or author.
    *
    * @param string $orderType
    * @return \Illuminate\Http\Response
    */
    public function index($orderType)
    {
        if ($orderType == 'titles') {
            //Sort by titles
            $books = Book::orderBy('title', 'asc')->paginate(20);
        } elseif ($orderType == 'authors') {
            //Sort by authors
            $books = Book::orderBy('author', 'asc')->paginate(20);
        } else {
            //Sort by default -> titles
            $books = Book::orderBy('title', 'asc')->paginate(20);
        }
        return view('books.index')->with('books', $books);
    }

    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('books.create');
    }

    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required'
        ]);
        //Create Book
        $book = new Book;
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->user_id = auth()->user()->id;
        $book->newest_update_user_id = auth()->user()->id;
        $book->save();

        return redirect('/books/create')
            ->with('success', 'Book entry added successfully');
    }

    /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
        $book = Book::find($id);
        $user = $book->user;
        $updater = $book->getUpdater();
        return view('books.show')->with('book', $book)
            ->with('creator', $user)
            ->with('updater', $updater);
    }

    /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
        $book = Book::find($id);
        return view('books.edit')->with('book', $book);
    }

    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required'
        ]);

        //Create BOOK
        $book = Book::find($id);
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->newest_update_user_id = auth()->user()->id;
        $book->save();

        return redirect('/books/list/titles')
            ->with('success', 'Book entry updated successfully');
    }

    /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
        $book = Book::find($id);
        $book->delete();

        return redirect('/books/list/titles')
            ->with('success', 'Book entry deleted successfully');
    }

    /**
    * Finds a collection of all books matching the search term, in terms of
    * their title or author fields.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function search(Request $request)
    {
        //Create matching Books
        $books = Book::where('title', 'LIKE', '%' . $request->search . '%')
            ->orWhere('author', 'LIKE', '%' . $request->search . '%')
            ->orderBy('title', 'asc')->paginate(20);
        return view('books.search')->with('books', $books);
    }

    /**
    * Creates a CSV file containing book data, depending on the dataType
    * specified dataType.
    *
    * @param string $dataType
    * @return mixed
    */
    public function exportCSV($dataType)
    {
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename=books.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        $file = fopen('php://output', 'w');

        if ($dataType == 'titles&authors') {
            $books = Book::orderBy('title', 'asc')->get();
            $columns = array('Title', 'Author');
            fputcsv($file, $columns);
            foreach ($books as $book) {
                fputcsv($file, array($book->title, $book->author));
            }
        } elseif ($dataType == 'titles') {
            $books = Book::orderBy('title', 'asc')->get();
            $columns = array('Title');
            fputcsv($file, $columns);
            foreach ($books as $book) {
                fputcsv($file, array($book->title));
            }
        } elseif ($dataType == 'authors'){
            $books = Book::orderBy('author', 'asc')->get();
            $columns = array('Author');
            fputcsv($file, $columns);
            foreach ($books as $book) {
                fputcsv($file, array($book->author));
            }
        } else {
            return redirect('books/export');
        }

        fclose($file);
        exit();
    }

    /**
    * Creates a XML file containing book data, depending on the dataType
    * specified dataType.
    *
    * @param string $dataType
    * @return mixed
    */
    public function exportXML($dataType)
    {
        header('Content-type: text/xml');
        header('Content-Disposition: attachment; filename="books.xml"');
        $xml = new \DomDocument("1.0","UTF-8");

        $booksContainer = $xml->createElement("books");
        $booksContainer = $xml->appendChild($booksContainer);

        if ($dataType == 'titles&authors') {
            $books = Book::orderBy('title', 'asc')->get();
            foreach ($books as $book) {
                $bookContainer = $xml->createElement("book");
                $bookContainer = $booksContainer->appendChild($bookContainer);

                $title = $xml->createElement("title", $book->title);
                $title = $bookContainer->appendChild($title);

                $author = $xml->createElement("author", $book->author);
                $author = $bookContainer->appendChild($author);
            }
        } elseif ($dataType == 'titles') {
            $books = Book::orderBy('title', 'asc')->get();
            foreach ($books as $book) {
                $bookContainer = $xml->createElement("book");
                $bookContainer = $booksContainer->appendChild($bookContainer);

                $title = $xml->createElement("title", $book->title);
                $title = $bookContainer->appendChild($title);
            }
        } elseif ($dataType == 'authors'){
            $books = Book::orderBy('author', 'asc')->get();
            foreach ($books as $book) {
                $bookContainer = $xml->createElement("book");
                $bookContainer = $booksContainer->appendChild($bookContainer);

                $author = $xml->createElement("author", $book->author);
                $author = $bookContainer->appendChild($author);
            }
        } else {
            return redirect('books/export');
        }

        $xml->FormatOutput = true;
        $xmlContent = $xml->saveXML();
        echo $xmlContent;
        exit();
    }
}
