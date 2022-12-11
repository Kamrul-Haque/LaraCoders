<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate();

        return BookResource::collection($books);
    }

    public function show($book)
    {
        return new BookResource(Book::findOrFail($book));
    }

    public function update(BookRequest $request, $book)
    {
        $valid = $request->validated();

        $book = Book::findOrFail($book);

        if ($request->hasFile('cover_image'))
        {
            try
            {
                if (Storage::disk('s3')->exists($book->cover_image))
                    Storage::disk('s3')->delete($book->cover_image);

                $valid['cover_image'] = $request->file('cover_image')->store('BookImages', 's3');
            }
            catch (\Exception $exception)
            {
                return back()->with('error', $exception->getMessage());
            }
        }

        if ($book->update($valid))
            return response()->json([
                'message' => 'Book Updated Successfully',
                'data' => new BookResource($book->fresh())
            ]);

        return response()->json(['error' => 'Something Went Wrong'], 500);
    }

    public function store(BookRequest $request)
    {
        $valid = $request->validated();

        if ($request->hasFile('cover_image'))
        {
            try
            {
                $valid['cover_image'] = $request->file('cover_image')->store('BookImages', 's3');
            }
            catch (\Exception $exception)
            {
                return back()->with('error', $exception->getMessage());
            }
        }

        $book = Book::create($valid);

        if ($book)
            return response()->json([
                'message' => 'Book Created Successfully',
                'data' => new BookResource($book)
            ]);

        return response()->json(['error' => 'Something Went Wrong'], 500);
    }

    public function destroy($book)
    {
        $book = Book::findOrFail($book);

        if ($book->delete())
            return response()->json(['message' => 'Book Deleted Successfully']);

        return response()->json(['error' => 'Something Went Wrong'], 500);
    }
}
