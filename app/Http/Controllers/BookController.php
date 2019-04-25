<?php

namespace App\Http\Controllers;

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
    public function store(Request $request)
    {
        $name = $request->name;

        //
    }

    /**
     * Delete a book.
     *
     * @param  Request $request
     * @return Response
     */
    public function destroy(Request $request)
    {
        $name = $request->name;

        //
    }
}
