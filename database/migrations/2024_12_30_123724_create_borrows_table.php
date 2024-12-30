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
        Schema::create('borrow', function (Blueprint $table) {
            $table->id('borrow_id');
            $table->string('book_id');
            $table->string('member_id');
            $table->string('member_name');
            $table->string('book_name');
            $table->string('borrow_qty');
            $table->string('borrow_date');
            $table->string('borrow_return');
            $table->string('borrow_status');
            $table->string('borrow_updated_at');
            $table->string('borrow_created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('borrow');
    }
};
