<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;

class SiteController extends Controller
{
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
        $site_model = new Site();
        $site_model->saveSiteInfo($sites['url'], $sites['note']);
        return redirect( route('sites') );
    }

    public function show($id)
    {
        $site = Site::find($id);
        return view('/site/show', compact('site'));
    }

    public function edit($id)
    {
        $site = Site::find($id);
        return view('/site/edit', compact('site'));
    }

    public function update($id, Request $request)
    {
        $sites = $request->all();
        Site::where('id', $id)->update(['note' => $sites['note']]);
        return redirect( route('site_show',['id' => $id]) );
    }
}
