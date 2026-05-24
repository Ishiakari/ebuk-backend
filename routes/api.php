<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Book;
use App\Models\Author;
use App\Models\Genre;
use App\Models\Status;

Route::get('/books', function () {
    $books = Book::with(['author', 'genre', 'status', 'bookFiles'])->orderBy('id', 'desc')->get()->map(function ($book) {
        return [
            'id' => $book->id,
            'title' => $book->title,
            'author' => $book->author ? $book->author->name : 'Unknown',
            'status' => $book->status ? $book->status->name : 'Borrowed',
            'genre' => $book->genre ? $book->genre->name : 'General',
            'cover_image' => $book->cover_image ? asset('storage/' . $book->cover_image) : null,
            'file_format' => $book->bookFiles->isNotEmpty() ? $book->bookFiles->first()->file_format : null,
            'description' => $book->description,
        ];
    });

    return response()->json($books);
});

Route::post('/books', function (Request $request) {
    $request->validate([
        'title' => 'required|string|max:255',
        'year' => 'nullable|integer',
        'author_name' => 'required|string|max:255',
        'genre_name' => 'required|string|max:255',
        'status_id' => 'required|exists:statuses,id',
        'description' => 'nullable|string',
        'file' => 'nullable|file|mimes:pdf,epub,mobi|max:51200', // max 50MB
        'cover_image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // max 5MB
    ]);

    // Find or create the author and genre by name
    $author = Author::firstOrCreate(['name' => $request->author_name]);
    $genre = Genre::firstOrCreate(['name' => $request->genre_name]);

    $book = new Book();
    $book->title = $request->title;
    $book->year = $request->year ?? date('Y');
    $book->author_id = $author->id;
    $book->genre_id = $genre->id;
    $book->status_id = $request->status_id;
    $book->description = $request->description;

    // Handle cover image upload
    if ($request->hasFile('cover_image')) {
        $coverPath = $request->file('cover_image')->store('covers', 'public');
        $book->cover_image = $coverPath;
    }

    $book->save();

    // Handle file upload
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $extension = $file->getClientOriginalExtension();
        $path = $file->store('book_files', 'public');
        
        \App\Models\BookFile::create([
            'book_id' => $book->id,
            'file_path' => $path,
            'file_format' => strtolower($extension),
            'file_size_bytes' => $file->getSize(),
        ]);
    }

    $book->load(['author', 'genre', 'status', 'bookFiles']);
    // Format the response similarly to GET to ensure immediate compatibility
    $bookData = [
        'id' => $book->id,
        'title' => $book->title,
        'author' => $book->author ? $book->author->name : 'Unknown',
        'status' => $book->status ? $book->status->name : 'Borrowed',
        'genre' => $book->genre ? $book->genre->name : 'General',
        'cover_image' => $book->cover_image ? asset('storage/' . $book->cover_image) : null,
        'file_format' => $book->bookFiles->isNotEmpty() ? $book->bookFiles->first()->file_format : null,
        'description' => $book->description,
    ];

    return response()->json($bookData, 201);
});

Route::get('/authors', function () {
    return response()->json(Author::all());
});

Route::get('/genres', function () {
    return response()->json(Genre::all());
});

Route::get('/statuses', function () {
    return response()->json(Status::all());
});