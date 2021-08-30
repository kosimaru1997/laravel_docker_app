<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;

class SiteController extends Controller
{
    //
    public function index()
    {
        return view('/memo/create');
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
