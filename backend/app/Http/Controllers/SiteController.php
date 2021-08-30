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
        // dd($sites);

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
        return redirect( route('site_new') );
    }
}
