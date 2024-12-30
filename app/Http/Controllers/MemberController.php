<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $member = Member::orderBy('member_id', 'desc')->get();
        return view('Library.member')->with('member', $member);
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
            'member_name' => 'required:member,member_name',
            'member_username' => 'required|unique:member,member_username'
        ]);

        $data = [
            'member_id' => $request->member_id,
            'member_name' => $request->member_name,
            'member_username' => $request->member_username,
            'member_updated_at' => DB::raw('NOW()'),
            'member_created_at' => DB::raw('NOW()')
        ];
        Member::create($data);
        return redirect()->to('member')->with('success', 'Successfully added a new member');
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
            'member_name' => 'required:member,member_name'
        ]);
        $data = [
            'member_name' => $request->member_name,
            'member_updated_at' => DB::raw('NOW()')
        ];
        Member::where('member_id', $id)->update($data);
        return redirect()->to('member')->with('success', 'Successfully update a member');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Member::where('member_id', $id)->delete();
        return redirect()->to('member')->with('success', 'Successfully deleted member');
    }
}
