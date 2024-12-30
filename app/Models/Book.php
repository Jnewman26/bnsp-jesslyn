<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    protected $fillable = [
        'book_id',
        'book_name',
        'book_genre',
        'book_author',
        'book_release',
        'book_publisher',
        'book_stock',
        'book_updated_at',
        'book_created_at'
        ];
    protected $table = 'book';
    public $timestamps = false;
}