<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/books', function () {
    return response()->json([
        ['id' => 1, 'title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald'],
        ['id' => 2, 'title' => '1984', 'author' => 'George Orwell']
    ]);
});