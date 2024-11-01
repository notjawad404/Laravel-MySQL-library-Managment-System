@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Edit Author</h2>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('authors.update', $author->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this author?');">
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
