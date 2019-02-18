<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{

    /**
     * Finds the user that created this book entry.
     *
     * @return object user
     */
    public function user()
    {
      return $this->belongsTo('App\User');
    }

    /**
     * Finds the user that most recently updated this book entry.
     *
     * @return object user
     */
    public function getUpdater()
    {
      $user = User::where('id', $this->newest_update_user_id)->first();
      return $user;
    }

    /**
     * Returns a collection of books, ordered first by specified $orderType
     * and second by secondary field. Pagination paramater specifies theme
     * paginate value, if a value of 0 is given no pagination will be applied.
     *
     * @param string $orderType
     * @param int $pagination
     * @return object $books
     */
    public static function getOrderedBy($orderType, $pagination)
    {
        if ($orderType === 'titles') {
            //Sort by titles
            $books = Book::orderBy('title', 'asc')
                ->orderBy('author', 'asc');
        } elseif ($orderType === 'authors') {
            //Sort by authors
            $books = Book::orderBy('author', 'asc')
                ->orderBy('title', 'asc');
        } else {
            //Sort by default -> titles
            $books = Book::orderBy('title', 'asc')
                ->orderBy('author', 'asc');
        }

        if ($pagination === 0) {
            return $books->get();
        } else {
            return $books->paginate($pagination);
        }
    }

    /**
     * Searches through all books and returns a collection of books that match
     * the search term. Matching is done by removing all spaces and special
     * characters as well as converting all text to lower case. This will
     * simplify searching for the user and increase the chance of positive
     * search results.
     *
     * @param string $search
     * @return object $booksReturn
     */
    public static function search($search)
    {
        $booksReturn = collect(new Book);
        //If nothing is searched, return nothing
        if ($search == '') {
            return $booksReturn;
        }
        //Remove all special characters, spaces and convert to lower case
        $search = strtolower(preg_replace('/[^A-Za-z0-9]/', '', $search));
        $books = Book::orderBy('title', 'asc')
            ->orderBy('author', 'asc')
            ->get();
        foreach ($books as $book) {
            $title = $book->title;
            $author = $book->author;
            //Remove all special characters, spaces and convert to lower case
            $title = strtolower(preg_replace('/[^A-Za-z0-9]/', '', $title));
            $author = strtolower(preg_replace('/[^A-Za-z0-9]/', '', $author));
            if (strpos($title, $search) !== false
                || strpos($author, $search) !== false) {
                 $booksReturn->push($book);
            }
        }
        return $booksReturn;
    }
}
