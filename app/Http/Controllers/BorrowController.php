<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrow;
use App\Models\Member;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BorrowController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $borrow = Borrow::orderBy('borrow_created_at', 'desc')->get();

        return view('Library.borrow')->with('borrow', $borrow);
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
        $member_id = $request->member_id;
        $book_id = $request->book_id;

        $member = Member::where('member_id', $member_id)->first(['member_name']);
        $book = Book::where('book_id', $book_id)->first(['book_name', 'book_stock']);

        if ($member) {
            $member_name = $member->member_name;
        }

        if ($book) {
            $book_name = $book->book_name;
            $book_stock = $book->book_stock;
        }

        if ($book_stock < $request->borrow_qty) {
            return redirect()->back()->with('error', 'Insufficient book stock.');
        }

        $borrow_return = Carbon::now()->addDays(7);

        $status = 1;

        $data = [
            'book_id' => $book_id,
            'member_id' => $member_id,
            'member_name' => $member_name,
            'book_name' => $book_name,
            'borrow_qty' => $request->borrow_qty,
            'borrow_date' => DB::raw('NOW()'),
            'borrow_return' => $borrow_return,
            'borrow_status' => $status,
            'borrow_updated_at' => DB::raw('NOW()'),
            'borrow_created_at' => DB::raw('NOW()')
        ];
        Borrow::create($data);

        $new_book_stock = $book_stock - $request->borrow_qty;
        $book->where('book_id', $book_id)->update([
            'book_stock' => $new_book_stock
        ]);

        return redirect()->to('book')->with('success', 'Successfully borrowed a book');
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
        $book_id = $request->book_id;
        $borrow_qty = $request->borrow_qty;
        $book = Book::where('book_id', $book_id)->first(['book_stock']);

        if ($book) {
            $book_stock = $book->book_stock;
        } else {
            dd('Book stock tidak ditemukan.');
        }

        $total_book_stock = $book_stock + $borrow_qty;

        $status = '2';
        $data = [
            'borrow_status' => $status,
            'borrow_updated_at' => DB::raw('NOW()')
        ];

        $book->where('book_id', $book_id)->update([
            'book_stock' => $total_book_stock
        ]);

        Borrow::where('borrow_id', $id)->update($data);

        return redirect()->to('borrow')->with('success', 'Successfully return borrow');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
