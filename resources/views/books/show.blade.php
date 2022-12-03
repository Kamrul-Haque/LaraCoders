@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card w-50 shadow border-0">
            <div class="card-body">
                <h4 class="text-center">Book</h4>
                <div class="d-flex">
                    <a href="{{ route('books.index') }}"
                       class="btn btn-secondary btn-sm">Back</a>


                    <a href="{{ route('books.edit',$book) }}"
                       class="btn btn-primary btn-sm mr-1">Edit</a>

                    <form action="{{ route('books.destroy', $book) }}"
                          class="col-md-6"
                          method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="btn btn-danger btn-sm">
                            Delete
                        </button>
                    </form>
                </div>
                <br>
                <table class="table table-bordered">
                    <tr>
                        <th>Title</th>
                        <td>{{ $book->title }}</td>
                    </tr>
                    <tr>
                        <th>Author</th>
                        <td>
                            @foreach($book->authors as $author)
                                <span class="badge rounded-pill bg-primary py-2 px-4"
                                      style="position: relative">
                                    {{ $author->name }}
                                    @if($author->pivot->royalty)
                                        [{{ $author->pivot->royalty }} %]
                                    @endif
                                    <form action="{{ route('books.remove-author',['book'=>$book,'author'=>$author]) }}"
                                          style="position: absolute; top: 25%; right: 0"
                                          method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                style="border: 0; background: transparent; color: white"
                                                onclick="return confirm('Remove Author?')">
                                            <i class="fa fa-times-circle"></i>
                                        </button>
                                    </form>
                                </span>
                            @endforeach
                            <a href="{{ route('books.assign-author.form', $book) }}"
                               class="btn btn-outline-primary btn-sm">Add</a>
                        </td>
                    </tr>
                    <tr>
                        <th>Publisher</th>
                        <td>{{ $book->publisher->name }}</td>
                    </tr>
                    <tr>
                        <th>Publishing Date</th>
                        <td>{{ $book->publishing_date }}</td>
                    </tr>
                    <tr>
                        <th>Last Printing Date</th>
                        <td>{{ $book->latest_printing_date }}</td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>{{ $book->isbn }}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection
