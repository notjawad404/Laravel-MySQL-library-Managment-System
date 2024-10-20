@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $book->title }}</h1>

        <!-- @if($book->image)
            <img src="{{ asset($book->image) }}" class="card-img-top" alt="{{ $book->title }}">
        @else
            <img src="{{ asset('images/book.png') }}" class="card-img-top" alt="Default Image">
        @endif -->

        <p><strong>Author:</strong> {{ $book->author->name }}</p>
        <p><strong>Category:</strong> {{ $book->category->name }}</p>
        <p><strong>Description:</strong> {{ $book->description }}</p>

        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary">Edit</a>

        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Delete</button>
        </form>

        <a href="{{ route('books.index') }}" class="btn btn-secondary">Back to Books</a>
    </div>
@endsection
