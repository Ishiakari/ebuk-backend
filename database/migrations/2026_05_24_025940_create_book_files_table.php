<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_files', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key (bigint unsigned)
            
            // Foreign Key linking directly back to your central books table
            $table->foreignId('book_id')->constrained('books')->onDelete('cascade');
            
            $table->string('file_path', 555);   // Where the physical file is stored in Laravel storage
            $table->string('file_format', 10);  // e.g., 'pdf', 'epub', 'azw3', 'mobi'
            $table->unsignedBigInteger('file_size_bytes'); // Bigint for measuring file storage size
            
            $table->timestamps(); // Generates created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_files');
    }
};