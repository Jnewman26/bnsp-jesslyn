<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\MemberController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/book');
});

Route::resource('/book', BookController::class);

Route::resource('/member', MemberController::class);

Route::resource('/borrow', BorrowController::class);