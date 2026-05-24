<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookFile extends Model
{
    protected $fillable = ['book_id', 'file_path', 'file_format', 'file_size_bytes'];
}
