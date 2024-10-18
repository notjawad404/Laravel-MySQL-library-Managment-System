<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Display all categories 
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    // Show the form for add a new category 
    public function create()
    {
        return view('categories.create');
    }

    // Save category in the database
    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);
        Category::create($request->all());
        return redirect()->route('categories.index');
    }

    // Show form for editing category 
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Update the category in database
    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required']);
        $category->update($request->all());
        return redirect()->route('categories.index');
    }

    // Delete the category form database 
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}

