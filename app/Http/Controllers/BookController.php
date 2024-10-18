<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    // Display all books
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    // Show the form for creating a new book
    public function create()
    {
        return view('books.create');
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

        // Handle image upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
            $book->image = $imagePath;
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
        $book = Book::findOrFail($id);
        return view('books.edit', compact('book'));
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

        // Handle image upload
        if ($request->hasFile('image')) {

            if ($book->image) {
                \Storage::delete('public/' . $book->image);
            }
            $imagePath = $request->file('image')->store('images', 'public');
            $book->image = $imagePath;
        }

        $book->description = $request->description;
        $book->save();

        return redirect()->route('books.index')->with('success', 'Book updated successfully.');
    }

    // Delete the specified book from database
    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        
        if ($book->image) {
            \Storage::delete('public/' . $book->image);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Book deleted successfully.');
    }
}
