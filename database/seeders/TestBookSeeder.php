<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Insert 1 Test Author
        $authorId = DB::table('authors')->insertGetId([
            'name' => 'F. Scott Fitzgerald',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 2. Insert 1 Test Genre
        $genreId = DB::table('genres')->insertGetId([
            'name' => 'Classic Fiction',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 3. Insert 1 Test Status
        $statusId = DB::table('statuses')->insertGetId([
            'name' => 'Reading',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. Insert 1 Test Book linked perfectly to your foreign keys!
        DB::table('books')->insert([
            'title' => 'The Great Gatsby',
            'year' => 1925,
            'description' => 'A beautiful test description for your mobile details view layout.',
            'author_id' => $authorId,
            'genre_id' => $genreId,
            'status_id' => $statusId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}