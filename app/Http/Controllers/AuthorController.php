<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Display all authors
    public function index()
    {
        $authors = Author::all();
        return view('authors.index', compact('authors'));
    }

    // Display form for adding a new author 
    public function create()
    {
        return view('authors.create');
    }

    // Save author in database 
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Author::create($request->all());
        return redirect()->route('authors.index');
    }

    // Show form for editing an author
    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    // Update the author in database 
    public function update(Request $request, Author $author)
    {
        $request->validate(['name' => 'required']);
        $author->update($request->all());
        return redirect()->route('authors.index');
    }

    // Delete an author from database 
    public function destroy(Author $author)
    {
        $author->delete();
        return redirect()->route('authors.index');
    }
}
