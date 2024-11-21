<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     * 会員一覧画面の表示
     */
    public function index()
    {
        $members = Member::all();
        return view('members.index' , compact('members'));
    }

    /**
     * Show the form for creating a new resource.
     * 新規会員画面の表示
     */
    public function create()
    {
        return view('members.create');
    }

    /**
     * Store a newly created resource in storage.
     * 新規会員の保存
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:members,email',
        ]);

        Member::create($request->all());
        return redirect()->route('members.index')->with('success' , '会員が登録されました');
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
     * 会員編集画面の表示
     */
    public function edit(Member $member)
    {
        return view('members.edit' , compact('member'));
    }

    /**
     * Update the specified resource in storage.
     * 会員情報の更新
     */
    public function update(Request $request, Member $member)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email|unique:members,email,' . $member->id,
        ]);

        $member->update($request->all());
        // ->with('success', '会員情報が更新されました')はフラッシュメッセージ
        // withメソッドを使用して
        // successはキーであり、このキーに関連付けられたメッセージが'会員情報が更新されました'です。
        return redirect()->route('members.index')->with('success' , '会員情報が更新されました');
    }

    /**
     * Remove the specified resource from storage.
     * 会員情報の削除
     */
    public function destroy(Member $member)
    {
        $member->delete();
        return redirect()->route('members.index')->with('success', '会員が削除されました');
    }
}
