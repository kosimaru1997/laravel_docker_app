<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;

class MemoController extends Controller
{
    //

    public function index()
    {
        return view('/memo/create');
    }

    public function store(Request $request) {
        $posts = $request->all();
        Memo::insert(['content' => $posts['content'], 'user_id' => \Auth::id()]);
        return redirect( route('memo') );
    }
}
