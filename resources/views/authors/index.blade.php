@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Authors</h1>

        <a href="{{ route('authors.create') }}" class="btn btn-success">Add New Author</a>

        @if($authors->isEmpty())
            <p>No authors available.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($authors as $author)
                        <tr>
                            <td>{{ $author->name }}</td>
                            <td>
                                <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
