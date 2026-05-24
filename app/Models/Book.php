<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function genre()
    {
        return $this->belongsTo(Genre::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function bookFiles()
    {
        return $this->hasMany(BookFile::class);
    }
}
