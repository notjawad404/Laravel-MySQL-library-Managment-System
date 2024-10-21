@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Author</h2>
        <form action="{{ route('authors.update', $author->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Author Name:</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $author->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Update Author</button>
        </form>
    </div>
@endsection
