<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Book;

Route::get('/books', function () {
    $books = Book::with(['author', 'genre', 'status', 'bookFile'])->get()->map(function ($book) {
        return [
            'id' => $book->id,
            'title' => $book->title,
            'author' => $book->author ? $book->author->name : 'Unknown',
            'status' => $book->status ? $book->status->name : 'Borrowed',
            'genre' => $book->genre ? $book->genre->name : 'General',
            'cover_image' => null,
            'file_format' => $book->bookFile ? $book->bookFile->file_format : null,
            'description' => $book->description,
        ];
    });

    return response()->json($books);
});