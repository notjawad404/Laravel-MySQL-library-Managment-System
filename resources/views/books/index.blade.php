@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Books</h2>
        <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Add New Book</a>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            @foreach($books as $book)
                <div class="col-md-4">
                    <div class="card mb-4">
                        @if($book->image)
                            <img src="data:image/jpeg;base64,{{ base64_encode($book->image) }}" alt="{{ $book->title }}" class="bookImg">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">Author: {{ $book->author->name }}</p>
                            <p class="card-text">Category: {{ $book->category->name }}</p>
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-info">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
