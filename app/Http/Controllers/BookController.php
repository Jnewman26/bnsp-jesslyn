<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $book = Book::orderBy('book_id', 'desc')->get();
        $member = Member::orderBy('member_id', 'desc')->get();
        return view('Library.index')->with('book', $book)->with('member', $member);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|digits:13|unique:book,book_id',
            'book_name' => 'required:book,book_name',
            'book_genre' => 'required:book,book_genre',
            'book_author' => 'required:book,book_author',
            'book_release' => 'required:book,book_release',
            'book_publisher' => 'required:book,book_publisher',
            'book_stock' => 'required:book,book_stock'
        ]);

        $data = [
            'book_id' => $request->book_id,
            'book_name' => $request->book_name,
            'book_genre' => $request->book_genre,
            'book_author' => $request->book_author,
            'book_release' => $request->book_release,
            'book_publisher' => $request->book_publisher,
            'book_stock' => $request->book_stock,
            'book_updated_at' => DB::raw('NOW()'),
            'book_created_at' => DB::raw('NOW()')
        ];
        Book::create($data);
        return redirect()->to('book')->with('success', 'Successfully added a new book');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'book_name' => 'required:book,book_name',
            'book_genre' => 'required:book,book_genre',
            'book_author' => 'required:book,book_author',
            'book_release' => 'required:book,book_release',
            'book_publisher' => 'required:book,book_publisher',
            'book_stock' => 'required:book,book_stock'
        ]);

        $data = [
            'book_name' => $request->book_name,
            'book_genre' => $request->book_genre,
            'book_author' => $request->book_author,
            'book_release' => $request->book_release,
            'book_publisher' => $request->book_publisher,
            'book_stock' => $request->book_stock,
            'book_updated_at' => DB::raw('NOW()')
        ];
        Book::where('book_id', $id)->update($data);
        return redirect()->to('book')->with('success', 'Successfully update a book');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Book::where('book_id', $id)->delete();
        return redirect()->to('book')->with('success', 'Successfully deleted book');
    }
}
