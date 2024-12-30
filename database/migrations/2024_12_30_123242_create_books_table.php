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
        Schema::create('book', function (Blueprint $table) {
            $table->string('book_id')->primary();
            $table->string('book_name');
            $table->string('book_genre');
            $table->string('book_author');
            $table->string('book_release');
            $table->string('book_publisher');
            $table->string('book_stock');
            $table->string('book_updated_at');
            $table->string('book_created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book');
    }
};
