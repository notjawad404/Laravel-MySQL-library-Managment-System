<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BookController;

// Home route
Route::get('/', function () {
    return redirect()->route('books.index');
});

// Books Routes
Route::resource('books', BookController::class);

// Authors Routes
Route::resource('authors', AuthorController::class);

// Categories Routes
Route::resource('categories', CategoryController::class);