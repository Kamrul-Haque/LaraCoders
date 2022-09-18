@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center">
        <div class="card shadow border-0 rounded w-50">
            <div class="card-body">
                <h4 class="text-center">Create Book</h4>
                <form action="{{ route('books.store') }}"
                      method="post">
                    @csrf
                    <div class="form-group my-3">
                        <label for="title">Title</label>
                        <input type="text"
                               name="title"
                               class="form-control"
                               value="{{ old('title') }}"
                               required>
                        @error('title')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="author">Author</label>
                        <input type="text"
                               name="author"
                               class="form-control"
                               value="{{ old('author') }}"
                               required>
                        @error('author')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="publisher">Publisher</label>
                        <input type="text"
                               name="publisher"
                               class="form-control"
                               value="{{ old('publisher') }}"
                               required>
                        @error('publisher')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="publishing_date">Publishing Date</label>
                        <input type="date"
                               name="publishing_date"
                               class="form-control"
                               value="{{ old('publishing_date') }}"
                               required>
                        @error('publishing_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="latest_printing_date">Latest Printing Date</label>
                        <input type="date"
                               name="latest_printing_date"
                               class="form-control"
                               value="{{ old('latest_printing_date') }}"
                               required>
                        @error('latest_printing_date')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <label for="isbn">ISBN</label>
                        <input type="number"
                               name="isbn"
                               class="form-control"
                               value="{{ old('isbn') }}"
                               required>
                        @error('isbn')
                        <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-3">
                        <a href="{{ route('books.index') }}"
                           class="btn btn-secondary">Back</a>
                        <button class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
