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
        return view('/memo/create');
    }

    public function store(Request $request) {
        $posts = $request->all();
        $request->validate([ 'content' => 'required']);

        DB::transaction(function() use($posts){
            $memo_id = Memo::insertGetId(['content' => $posts['content'], 'user_id' => \Auth::id()]);
            $tag_exists = Tag::where('user_id', '=', \Auth::id())
            ->where('name', '=', $posts['new_tag'])->exists();
            if (!empty($posts['new_tag']) && !$tag_exists) {
                $tag_id = Tag::insertGetId(['user_id' => \Auth::id(), 'name' => $posts['new_tag']]);
                MemoTag::insert(['memo_id' => $memo_id, 'tag_id' => $tag_id]);
            };

            if(!empty($posts['tags'][0])){
                foreach($posts['tags'] as $tag){
                    MemoTag::insert(['memo_id' => $memo_id, 'tag_id' => $tag]);
                }
            }
        });
        return redirect( route('memo') );
    }

    public function edit($id){

        $edit_memo = Memo::select('memos.*', 'tags.id AS tag_id')
            ->leftJoin('memo_tags', 'memo_tags.memo_id', '=', 'memos.id')
            ->leftJoin('tags', 'memo_tags.tag_id', '=', 'tags.id')
            ->where('memos.user_id', '=', \Auth::id())
            ->where('memos.id', '=', $id)
            ->whereNull('memos.deleted_at')
            ->get();

        $include_tags = [];
        foreach($edit_memo as $memo){
            array_push($include_tags, $memo['tag_id']);
        }

        $tags = Tag::where('user_id', '=', \Auth::id())
            ->whereNull('deleted_at')
            ->orderBy('id', 'DESC')
            ->get();

        return view('/memo/edit', compact('edit_memo', 'include_tags', 'tags') );
    }

    public function update(Request $request){
        $posts = $request->all();
        $request->validate([ 'content' => 'required']);

        DB::transaction(function () use($posts){

            Memo::where('id', $posts['memo_id'])->update(['content' => $posts['content']]);

            MemoTag::where('memo_id', '=', $posts['memo_id'])->delete();

            $tag_exists = Tag::where('user_id', '=', \Auth::id())
            ->where('name', '=', $posts['new_tag'])->exists();
            if (!empty($posts['new_tag']) && !$tag_exists) {
                $tag_id = Tag::insertGetId(['user_id' => \Auth::id(), 'name' => $posts['new_tag']]);
                MemoTag::insert(['memo_id' => $posts['memo_id'], 'tag_id' => $tag_id]);
            };

            foreach($posts['tags'] as $tag){
                MemoTag::insert(['memo_id' => $posts['memo_id'], 'tag_id'=> $tag]);
            };
        });

        return redirect( route('memo') );
    }

    public function destroy(Request $request){
        $posts = $request->all();
        Memo::where('id', $posts['memo_id'])
        ->update(['deleted_at' => date("Y-m-d H:i:s", time())]);
        return redirect( route('memo') );
    }
}
