<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;

class MemoController extends Controller
{
    //

    public function index()
    {
        $memos = Memo::select('memos.*')
            ->where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('id', 'DESC')
            ->get();

        return view('/memo/create', compact('memos'));
    }

    public function store(Request $request) {
        $posts = $request->all();
        Memo::insert(['content' => $posts['content'], 'user_id' => \Auth::id()]);
        return redirect( route('memo') );
    }

    public function edit($id) {
        $memos = Memo::select('memos.*')
            ->where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('id', 'DESC')
            ->get();

        $edit_memo = Memo::find($id);
        return view('/memo/edit', compact('memos', 'edit_memo') );
    }

    public function update(Request $request) {
        $posts = $request->all();
        Memo::where('id', $posts['memo_id'])
        ->update(['content' => $posts['content'], 'user_id' => \Auth::id()]);
        return redirect( route('memo') );
    }

    public function destroy(Request $request) {
        $posts = $request->all();
        Memo::where('id', $posts['memo_id'])
        ->update(['deleted_at' => date("Y-m-d H:i:s", time())]);
        return redirect( route('memo') );
    }
}
