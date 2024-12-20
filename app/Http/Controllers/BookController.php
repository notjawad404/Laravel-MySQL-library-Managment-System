<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Display all books
    public function index()
    {
        $books = Book::orderBy('title', 'asc')->get();
        return view('books.index', compact('books'));
    }

    // Show the form for creating a new book
    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();

        return view('books.create', compact('authors', 'categories'));
    }

    // Store a new book in database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $book = new Book();
        $book->title = $request->title;
        $book->author_id = $request->author_id;
        $book->category_id = $request->category_id;

        // Handle image upload and store as blob
        if ($request->hasFile('image')) {
            $book->image = file_get_contents($request->file('image')->getRealPath());
        }

        $book->description = $request->description;
        $book->save();

        return redirect()->route('books.index')->with('success', 'Book created successfully.');
    }

    // Display the specified book
    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('books.show', compact('book'));
    }

    // Show the form for editing the specified book
    public function edit($id)
    {
        $authors = Author::all();
        $categories = Category::all();
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book','authors', 'categories'));
    }

    // Update the specified book in database
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ]);

        $book = Book::findOrFail($id);
        $book->title = $request->title;
        $book->author_id = $request->author_id;
        $book->category_id = $request->category_id;

        // Handle image upload and store as blob
        if ($request->hasFile('image')) {
            $book->image = file_get_contents($request->file('image')->getRealPath());
        }

        $book->description = $request->description;
        $book->save();

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    // Delete the specified book from database
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
