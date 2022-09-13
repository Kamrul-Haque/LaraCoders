<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:25'],
            'author' => ['required', 'string', 'min:3', 'max:25'],
            'publisher' => ['required', 'string', 'min:3', 'max:25'],
            'publishing_date' => ['required', 'date', 'before_or_equal:today'],
            'latest_printing_date' => ['required', 'date', 'before_or_equal:today', 'after_or_equal:publishing_date'],
            'isbn' => ['required', 'integer', 'digits_between:5,15'],
        ]);

        $book = new Book();
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->publisher = $request->input('publisher');
        $book->publishing_date = $request->input('publishing_date');
        $book->latest_printing_date = $request->input('latest_printing_date');
        $book->isbn = $request->input('isbn');
        $book->save();

        return redirect()->route('books.index');
    }

    public function index()
    {
        $books = Book::all();

        return view('books.index', ['books' => $books]);
    }

    public function edit($book)
    {
        $book = Book::findOrFail($book);

        return view('books.edit', ['book' => $book]);
    }

    public function update(Request $request, $book)
    {
        $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:25'],
            'author' => ['required', 'string', 'min:3', 'max:25'],
            'publisher' => ['required', 'string', 'min:3', 'max:25'],
            'publishing_date' => ['required', 'date', 'before_or_equal:today'],
            'latest_printing_date' => ['required', 'date', 'before_or_equal:today', 'after_or_equal:publishing_date'],
            'isbn' => ['required', 'integer', 'digits_between:5,15'],
        ]);

        $book = Book::findOrFail($book);
        $book->title = $request->input('title');
        $book->author = $request->input('author');
        $book->publisher = $request->input('publisher');
        $book->publishing_date = $request->input('publishing_date');
        $book->latest_printing_date = $request->input('latest_printing_date');
        $book->isbn = $request->input('isbn');
        $book->save();

        return redirect()->route('books.index');
    }

    public function destroy($book)
    {
        $book = Book::findOrFail($book);

        $book->delete();

        return back();
    }
}
