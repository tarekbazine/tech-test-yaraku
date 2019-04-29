<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBook;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BookController extends Controller
{

    /**
     * List books.
     *
     * @param  Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $books = Book::all();

        return view('front_end.book.index', [
            'books' => $books,
        ]);
    }

    /**
     * Store a new book.
     *
     * @param  Request $request
     * @return Response
     */
    public function store(StoreBook $request)
    {
        $title = $request->input('title');
        $author_name = $request->input('author_name');

        try {

            Book::create([
                'title' => $title,
                'author_name' => $author_name,
            ]);

            flash()->success('Book Added [ Title: ' . $title . ' ]');

        } catch (\Exception $e) {

            flash()->error('Book NOT Added ! Error');

        }


        return redirect('/');
    }

    /**
     * Delete a book.
     *
     * @param  Request $request
     * @return Response
     */
    public function destroy(Book $book)
    {
        try {

            $book->delete();

            flash()->success('Book Deleted [ Title: ' . $book->title . ' ]');

        } catch (\Exception $e) {

            flash()->error('Book NOT Deleted ! Error');

        }


        return redirect('/');
    }
}
