<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    //
    public function index()
    {
        return view('/memo/create');
    }

    public function new()
    {
        return view('/site/new');
    }
}
