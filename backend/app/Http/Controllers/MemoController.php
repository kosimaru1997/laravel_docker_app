<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;
use App\Models\Tag;
use App\Models\MemoTag;
use DB;

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

        $tags = Tag::where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('id', 'DESC')
            ->get();

        return view('/memo/create', compact('memos','tags'));
    }

    public function store(Request $request) {
        $posts = $request->all();

        DB::transaction(function() use($posts){
            $memo_id = Memo::insertGetId(['content' => $posts['content'], 'user_id' => \Auth::id()]);
            $tag_exists = Tag::where('user_id', '=', \Auth::id())
            ->where('name', '=', $posts['new_tag'])->exists();
            if (!empty($posts['new_tag']) && !$tag_exists) {
                $tag_id = Tag::insertGetId(['user_id' => \Auth::id(), 'name' => $posts['new_tag']]);
                MemoTag::insert(['memo_id' => $memo_id, 'tag_id' => $tag_id]);
            };

            foreach($posts['tags'] as $tag){
                MemoTag::insert(['memo_id' => $memo_id, 'tag_id'=> $tag]);
            };
        });
        return redirect( route('memo') );
    }

    public function edit($id){
        $memos = Memo::select('memos.*')
            ->where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('id', 'DESC')
            ->get();

        $edit_memo = Memo::find($id);
        return view('/memo/edit', compact('memos', 'edit_memo') );
    }

    public function update(Request $request){
        $posts = $request->all();
        Memo::where('id', $posts['memo_id'])
        ->update(['content' => $posts['content'], 'user_id' => \Auth::id()]);
        return redirect( route('memo') );
    }

    public function destroy(Request $request){
        $posts = $request->all();
        Memo::where('id', $posts['memo_id'])
        ->update(['deleted_at' => date("Y-m-d H:i:s", time())]);
        return redirect( route('memo') );
    }
}
