@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Authors</h1>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
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
                                <form action="{{ route('authors.destroy', $author->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Are you sure you want to delete this author?\n This will delete all the related books to this?');">
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
