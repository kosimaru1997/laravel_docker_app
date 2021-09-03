<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreSiteRequest;
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
        $query_tag = \Request::query('tag');
        if(empty($query_tag)){
            $sites = Site::where('user_id', '=', \Auth::id())->orderBy('created_at', 'DESC')->get();
        }else{
            $sites = Tag::find($query_tag)->sites;
        }

        $site_ids = $sites->pluck('id');
        $tag_ids = SiteTag::whereIn('site_id',$site_ids)->pluck('tag_id');
        $tags = Tag::whereIn('id', $tag_ids)->get();

        return view('/site/index', compact('sites', 'tags'));
    }

    public function create()
    {
        return view('/site/new');
    }

    public function store(StoreSiteRequest $request)
    {
        $sites = $request->all();
        $site_id = null;

        DB::transaction(function() use(&$site_id, $sites){

            $site_model = new Site();
            $site_id = $site_model->saveSiteInfo($sites['url'], $sites['note']);

            if(!empty($sites['tag']) && !is_null($site_id)){

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

        if(!is_null($site_id)){
            return redirect( route('sites') );
        }else{
            return view('/site/new', compact('sites'));
        }
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

    public function search(Request $request)
    {
        $query = $request->all();

        if(is_null($query['tags'])){
            $user_sites = Site::where('user_id', '=', \Auth::id());
        }else{
            $user_sites = Tag::find($query['tags'])->sites;
        }

        if($query['option'] == 'mix'){
            $relation = $user_sites->where('title', 'LIKE', "%{$query['word']}%")
                              ->orWhere('description', 'LIKE', "%{$query['word']}%")
                              ->orWhere('note', 'LIKE', "%{$query['word']}%")
                              ->where('user_id', '=', \Auth::id());
        }elseif($query['option'] == 'title'){
            $relation = $user_sites->where('title', 'LIKE', "%{$query['word']}%")
                              ->andWhere('user_id', '=', \Auth::id());
        }elseif($query['option'] == 'note'){
            $relation = $user_sites->where('note', 'LIKE', "%{$query['word']}%")
                              ->andWhere('user_id', '=', \Auth::id());
        }

        if($query['sort'] == 'new'){
            $sites = $relation->orderBy('created_at', 'DESC')->get();
        }else{
            $sites = $relation->get();
        }

        $site_ids = $sites->pluck('id');
        $tag_ids = SiteTag::whereIn('site_id',$site_ids)->pluck('tag_id');
        $tags = Tag::whereIn('id', $tag_ids)->get();

        return view('/site/index', compact('sites', 'tags'));
    }
}
