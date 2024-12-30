<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrow extends Model
{
    use HasFactory;
    protected $fillable = [
        'borrow_id',
        'book_id',
        'member_id',
        'member_name',
        'book_name',
        'borrow_qty',
        'borrow_date',
        'borrow_return',
        'borrow_status',
        'borrow_updated_at',
        'borrow_created_at'
        ];
    protected $table = 'borrow';
    public $timestamps = false;
}
