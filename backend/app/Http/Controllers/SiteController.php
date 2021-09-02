<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\SiteTag;
use App\Models\Tag;
use DB;

class SiteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    //
    public function index()
    {
        $sites = Site::where('user_id', '=', \Auth::id())->get();

        return view('/site/index', compact('sites'));
    }

    public function create()
    {
        return view('/site/new');
    }

    public function store(Request $request)
    {
        $sites = $request->all();

        DB::transaction(function() use($sites){

            $site_model = new Site();
            $site_id = $site_model->saveSiteInfo($sites['url'], $sites['note']);

            if(!empty($sites['tag'])){

            $tag_list = preg_split("/[\s,]+/", $sites['tag']);
            foreach($tag_list as $tag){
                $tag_exists = Tag::where('user_id', '=', \Auth::id())
                ->where('name', '=', $tag)->exists();
                if(!$tag_exists){
                    $tag_id = Tag::insertGetId(['user_id' => \Auth::id(), 'name' => $tag]);
                    SiteTag::insert(['site_id' => $site_id, 'tag_id' => $tag_id]);
                }
            }
        }
        });

        return redirect( route('sites') );
    }

    public function show($id)
    {
        $site = Site::find($id);
        $tags = $site->tags;
        $Parsedown = new \Parsedown();
        return view('/site/show', compact('site', 'tags', 'Parsedown'));
    }

    public function edit($id)
    {
        $site = Site::find($id);
        $tags = $site->tags;
        return view('/site/edit', compact('site', 'tags'));
    }

    public function update($id, Request $request)
    {
        $sites = $request->all();

        DB::transaction(function () use($id, $sites){

            Site::where('id', $id)->update(['note' => $sites['note']]);
            SiteTag::where('site_id', '=', $id)->delete();

            if(!empty($sites['tag'])){

                $tag_list = preg_split("/[\s,]+/", $sites['tag']);
                foreach($tag_list as $tag){
                    $tag_exists = Tag::where('user_id', '=', \Auth::id())
                    ->where('name', '=', $tag)->exists();
                    if(!$tag_exists){
                        $tag_id = Tag::insertGetId(['user_id' => \Auth::id(), 'name' => $tag]);
                        SiteTag::insert(['site_id' => $id, 'tag_id' => $tag_id]);
                    }
                }
            }

            if(!empty($sites['tags'][0])){
                foreach($sites['tags'] as $tag){
                    SiteTag::insert(['site_id' => $id, 'tag_id'=> $tag]);
                };
            };

        });

        return redirect( route('site_show',['id' => $id]) );
    }

    public function destroy($id)
    {
        Site::where('id', $id)->delete();
        return redirect( route('sites'));
    }
}
