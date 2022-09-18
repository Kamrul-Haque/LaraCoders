<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return view('books.index', compact('books'));
    }

    public function store(Request $request)
    {
        $valid = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:25'],
            'author' => ['required', 'string', 'min:3', 'max:25'],
            'publisher' => ['required', 'string', 'min:3', 'max:25'],
            'publishing_date' => ['required', 'date', 'before_or_equal:today'],
            'latest_printing_date' => ['required', 'date', 'before_or_equal:today', 'after_or_equal:publishing_date'],
            'isbn' => ['required', 'integer', 'digits_between:5,10', 'unique:books'],
        ]);

        if (Book::create($valid))
            return redirect()->route('books.index')->with('success', 'Book Created Successfully');

        return back()->with('error', 'Something went wrong');
    }

    public function create()
    {
        return view('books.create');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $valid = $request->validate([
            'title' => ['required', 'string', 'min:3', 'max:25'],
            'author' => ['required', 'string', 'min:3', 'max:25'],
            'publisher' => ['required', 'string', 'min:3', 'max:25'],
            'publishing_date' => ['required', 'date', 'before_or_equal:today'],
            'latest_printing_date' => ['required', 'date', 'before_or_equal:today', 'after_or_equal:publishing_date'],
            'isbn' => ['required', 'integer', 'digits_between:5,10', 'unique:books,isbn,' . $book->id],
        ]);

        if ($book->update($valid))
            return redirect()->route('books.index')->with('success', 'Book Updated Successfully');

        return back()->with('error', 'Something went wrong');
    }

    public function destroy(Book $book)
    {
        if ($book->delete())
            return back()->with('success', 'Book Deleted Successfully');

        return back()->with('error', 'Something went wrong');
    }
}
